<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use \Carbon\Carbon;

use App\Entrie;
use App\User;
use App\Chef;
use App\Studio;
use App\Description;
use App\DescriptionType;
use App\Information;
use App\TechMsg;

class EntryRepository{

    // display one particular entry in separate view, used by bingo boom tech support
    public function showOneEntry($entryId)
    {
        $entry = Entrie::with('studio','user','user.operator','type', 'chef')
            ->find($entryId);

        return $entry;
    }


    public function filter( $request, $studioName)
    {
        \Bouncer::ownedVia(Entrie::class, 'user_id'); // make association between events and operators that own them to display edit button

        $studio = Studio::where('name_eng', $studioName)->first();
        $studioId = $studio->id;

        $query = Entrie::where('studio_id', $studioId)->latest();

        list($entryType, $announcement, $criteria, $criteriadate, $query) = $this->_filterByRequest($request, $query);

        $entries = $query->with('chef', 'user', 'user.operator', 'type')->paginate(20);

        $viewData = array_merge(
            $this->_getJournalViewData($studioId),
            compact('entries', 'studioId', 'studio', 'entryType', 'announcement', 'criteria', 'criteriadate')
        );

        return view('main_view.entry.main_section', $viewData );
    }


    protected function _filterByRequest(Request $request, Builder &$query)
    {

        $criteria = null;
        $criteriadate = null;

        if(isset($request->criteria) || isset($request->criteriadate)) {

            $criteria = $request->criteria;

            switch ($criteria) {
                case 'todayEntries':
                    $query->whereDate('created_at', Carbon::today());
                    break;

                case 'yesterdayEntries':
                    $query->whereDate('created_at', Carbon::yesterday());
                    break;

                case 'weekEntries':
                    $query->where('created_at', '>=', Carbon::now()->subWeek());
                    break;

                case 'monthEntries':
                    $query->where('created_at', '>=', Carbon::now()->subMonth());
                    break;
                case 'dateEntries':
                    $query->whereDate('created_at', Carbon::parse($request->criteriadate));
                    break;
            }
        }


        $request->entryType ? $query->where('description_type_id', $request->entryType) : null;


        $request->announcement ? $query->where(function ($q) {
            return $q->where('announcement_del', 1)->orWhere('announcement', 1);
        }) : null ;


        return [$request->entryType, $request->announcement, $criteria, $criteriadate, $query];
    }


    private function _getJournalViewData($studioId)
    {
        $key = 'journalViewData';
        $commonViewData = \Cache::get($key, function () use ($key) {
            $allstudios = Studio::where('name_eng', '!=', 'chef')->get();
            $alloperators = User::getUsersByRole('operator');
            $chefs = Chef::all();
            $descriptionTypes = DescriptionType::orderBy('id', 'asc')->get();
            $result = compact( 'alloperators', 'allstudios', 'descriptionTypes', 'chefs');
            cache()->put($key, $result, 10);
            return $result;
        });
        $informationData = $this->_getInformationData();
        $alloperators = $commonViewData['alloperators'];
        $operators = $alloperators->where('studio_id', $studioId);
        $announcements = Entrie::where('studio_id', $studioId)->where('announcement', true)->latest()->get();
        $descriptions = Description::where('studio_id', $studioId)->orderBy('frequency', 'asc')->get();
        $techSupportMessages = TechMsg::where('studio_id', $studioId)->orderBy('order', 'asc')->get();


        return array_merge($commonViewData, $informationData, compact('operators','descriptions', 'techSupportMessages', 'announcements'));
    }


    private function _getInformationData()
    {
        $key = 'journalViewData.information';

        return cache()->get($key, function () use ($key) {
            $instruction = Information::where('name', 'instruction')->first();
            $notification = Information::where('name', 'notification')->first();
            $notice = Information::where('name', 'notice')->first();
            $result = compact('instruction', 'notice', 'notification');
            cache()->put($key, $result, 60);
            return $result;
        });
    }


}
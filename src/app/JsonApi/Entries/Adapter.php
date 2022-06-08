<?php

namespace App\JsonApi\Entries;

use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use App\Studio;

class Adapter extends AbstractAdapter
{

    /**
     * Mapping of JSON API attribute field names to model keys.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Mapping of JSON API filter names to model scopes.
     *
     * @var array
     */
    protected $filterScopes = [];

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new \App\Entrie(), $paging);
    }

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
        if(empty($filters->all())){
            $this->filterWithScopes($query, $filters);
        }else{
            foreach ($filters->all() as $key => $arrayOfPredicators){
                $filterName = $key;


                if($filterName == 'rng_id'){
                    $studio = Studio::where('rng_id', $arrayOfPredicators['eq'])->first();
                    $filterName = 'studio_id';
                    $arrayOfPredicators['eq'] = $studio->id;
                }

                if(!Schema::hasColumn('entries',$filterName))
                {
                    abort(404);
                }

                foreach ($arrayOfPredicators as $predicatorKey => $predicatorValue){
                    $this->filterQuery($query, $filterName, $predicatorKey, $predicatorValue );
                }
            }
        }
    }


    public function filterQuery($query, $filterName, $predicatorKey, $predicatorValue){

        if($filterName == 'occurred_at'){

            $parsedPredicatorValue = Carbon::parse($predicatorValue); // UTC
            $parsedValueToDateTimeString = $parsedPredicatorValue->toDateTimeString();
            $parsedValueToLocalTime = Carbon::parse($parsedValueToDateTimeString, 'Asia/Yerevan'); //UTC + Locale
            $diffInHours = $parsedPredicatorValue->diffInHours($parsedValueToLocalTime);
            $predicatorValueMinusLocalTimezone = $parsedPredicatorValue->addHours($diffInHours);


            if($predicatorKey == 'ge'){
                $query->where($filterName, '>=', $predicatorValueMinusLocalTimezone );
            }elseif($predicatorKey == 'gt'){
                $query->where($filterName, '>', $predicatorValueMinusLocalTimezone );
            }elseif($predicatorKey == 'lt'){
                $query->where($filterName, '<', $predicatorValueMinusLocalTimezone );
            }elseif($predicatorKey == 'le'){
                $query->where($filterName, '<=', $predicatorValueMinusLocalTimezone );
            }elseif($predicatorKey == 'eq'){
                $query->where($filterName, '=', $predicatorValueMinusLocalTimezone );
            }elseif($predicatorKey == 'ne'){
                $query->where($filterName, '!=', $predicatorValueMinusLocalTimezone );
            }else{
                abort(404);
            }

        }else{

            if($predicatorKey == 'ge'){
                $query->where($filterName, '>=', $predicatorValue );
            }elseif($predicatorKey == 'gt'){
                $query->where($filterName, '>', $predicatorValue );
            }elseif($predicatorKey == 'lt'){
                $query->where($filterName, '<', $predicatorValue );
            }elseif($predicatorKey == 'le'){
                $query->where($filterName, '<=', $predicatorValue );
            }elseif($predicatorKey == 'eq'){
                $query->where($filterName, '=', $predicatorValue );
            }elseif($predicatorKey == 'ne'){
                $query->where($filterName, '!=', $predicatorValue );
            }elseif($predicatorKey == 'contains' || $predicatorKey == 'starts' || $predicatorKey == 'ends'){
                $query->where($filterName, 'like', '%'.$predicatorValue.'%'  );
            }else{
                abort(404);
            }


        }



    }


    protected function user(){

        return $this->hasOne();
    }

      protected function type(){

        return $this->hasOne();
    }

      protected function chef(){

        return $this->hasOne();
    }

      protected function studio(){

        return $this->hasOne();
    }



}



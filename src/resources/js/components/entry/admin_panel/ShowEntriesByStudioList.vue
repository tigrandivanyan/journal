<template>



    <!--<div class="panel-body">    &lt;!&ndash; panel content &ndash;&gt;-->
        <!--<div class="table-responsive">-->
            <!--@if(count($entries))-->
            <!--<table class="table table-condensed table-vertical-middle nomargin">-->
                <!--<thead>-->
                <!--<tr>-->
                    <!--<th>___ID___</th>-->
                    <!--<th>Тур</th>-->
                    <!--<th>Дата</th>-->
                    <!--<th>Время</th>-->
                    <!--<th>Текст</th>-->
                    <!--<th>Оператор</th>-->
                    <!--<th>Дежурный</th>-->
                    <!--<th>Тип</th>-->
                    <!--<th>Объявление</th>-->
                    <!--<th>Почта</th>-->
                    <!--<th>Создано</th>-->
                <!--</tr>-->
                <!--</thead>-->
                <!--<tbody>-->

                <!--@foreach($entries as $entry)-->

                <!--<tr>-->
                    <!--<td class="entry_id" data-entry-id="{{$entry->id}}">{{$entry->id}}</td>-->
                    <!--<td class="entry_tour"  data-entry-id="{{$entry->id}}" >{{$entry->tour}}</td>-->
                    <!--<td class="entry_date"  data-entry-id="{{$entry->id}}">{{$entry->occurred_at->toTimeString()}}</td>-->
                    <!--<td class="entry_time"  data-entry-id="{{$entry->id}}">{{$entry->occurred_at->toDateString()}}</td>-->
                    <!--<td class="entry_description"  data-descrentryiption-id="{{$entry->id}}" >{{$entry->description}}</td>-->
                    <!--<td class="entry_type"  data-entry-id="{{$entry->id}}" >{{ isset($entry->operator->name_ru) ? $entry->operator->name_ru : '-' }}</td>-->
                    <!--<td class="entry_type"  data-entry-id="{{$entry->id}}" >{{ isset($entry->chef->name_ru) ? $entry->chef->name_ru : '-' }}</td>-->
                    <!--<td class="entry_type"  data-entry-id="{{$entry->id}}" >{{ isset($entry->type->ru_name) ? $entry->type->ru_name : '-' }}</td>-->
                    <!--<td class="entry_mark"  data-entry-id="{{$entry->id}}" >{{$entry->announcement}}</td>-->
                    <!--<td class="entry_mail"  data-entry-id="{{$entry->id}}" >{{$entry->mail}}</td>-->
                    <!--<td class="entry_created_ad"  data-entry-id="{{$entry->id}}" >{{$entry->created_at}}</td>-->
                <!--</tr>-->

                <!--@endforeach-->
                <!--@else-->
                <!--<div class="alert alert-danger" role="alert">-->
                    <!--Событий с такими данными нету!-->
                <!--</div>-->
                <!--@endif-->
                <!--</tbody>-->
            <!--</table>-->
            <!--{{&#45;&#45;pagination links&#45;&#45;}}-->
            <!--{{&#45;&#45;                {{ $entries->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}&#45;&#45;}}-->
            <!--{!! $entries->links() !!}-->


        <!--</div>-->
    <!--</div>     &lt;!&ndash; /panel content &ndash;&gt;-->


</template>

<script>

    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "show_one_entry_for_tech_support",
        computed: {
            ...mapGetters(
                [
                    // 'getOneEntryForTechSupport',
                ]
            )
        },
        created(){
            // this.fetchOneEntryForTechSupport();
        },
        methods:{
            ...mapActions(
                [
                    // 'fetchOneEntryForTechSupport',
                ]
            )
        }
    }
</script>

<style scoped>

    .card{
        margin-left:20%;
        margin-right:20%;
    }

    .underline-text{
        text-decoration:underline;
    }

</style>


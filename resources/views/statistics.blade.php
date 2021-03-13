@extends('layouts.app')

@section('content')

<style type="text/css">
    .tableFixHead { 
        overflow-y: auto; 
        height: 100px; 
    }
    .tableFixHead thead th { 
        position: sticky; 
        top: 0; 
    }    
    body {
        background-color: white;
    }    
</style>

<div class="container-fluid">

    <div class="justify-content-between row flex-row-reverse">
        <div class="dt-but tons btn-group"> 
            <button class="btn btn-secondary buttons-excel buttons-html5 btn-success mr-3 mb-2" tabindex="0" aria-controls="table_id" type="button">
                <span><i class="fas fa-file-excel pr-2"></i>Export</span>
            </button>
        </div>
        <div id="table_id_filter" class="dataTables_filter">
            <h1>{{$today}}</h1>
        </div>
        <div></div>
    </div>


    <table class="table table-hover table-bordered table-sm table-striped tableFixHead">
        <thead class="thead-dark">
            @php
                $days = 31;
                $num = 1;
                $stats = ['Pick', 'Pick Lines', 'Lines Qty', 'Packs', 'Pack Lines', 'Line Qty'];
                $fields = ['picks', 'pick_lines', 'pick_lines_qty', 'packs', 'pack_lines', 'pack_lines_qty'];

            @endphp
            <tr>
                <th >#</th>
                <th >Name</th>
                <th >Statistics</th>
                @for ($i = 1; $i <= $days; $i++)
                    <th class="text-center" scope="col">{{$i}}</th>
                @endfor
            </tr>
        </thead>
        <tbody style="height: 10px !important; overflow: scroll; ">
            @foreach ($employeeList as $key => $employee)
                @for ($i = 0; $i < count($stats); $i++)
                    <tr>
                        @if ($i == 0)
                            <td class="text-center align-middle" rowspan="6">{{ $loop->index+1 }}</td>
                            <td class="text-center align-middle" rowspan="6">{{$key}}</td>
                        @endif
                        <td>{{$stats[$i]}}</td>
                        @for ($d = 1; $d <= $days; $d++)
                            <td class="text-center">{{ $employee[$d][$fields[$i]] }}</td>
                        @endfor
                    </tr>
                @endfor
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
</script>

@endsection
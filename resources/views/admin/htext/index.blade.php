@extends('layouts.admin')
@push('stylesheet')
<style>
    .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    }

    .switch input {
    opacity: 0;
    width: 0;
    height: 0;
    }

    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    }

    .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    }

    input:checked + .slider {
    background-color: #2196F3;
    }

    input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }

    .slider.round:before {
    border-radius: 50%;
    }

    #toast-container{
        margin-top : 20px;
    }

    #toast-container > .toast {
    width: 370px !important;
    }
</style>
@endpush
@section('content')

   

      
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary float-right" href="{{ route('admin.htext.create') }}">

                    Add Header Text
                </a>
            </div>
        </div>
        
    <div class="card">
        <div class="card-header">
           Header Text List
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Slider">
                <thead class="thead-dark">
                    <tr class="text-center">
                        
                        <th>
                            {{ trans('cruds.slider.fields.id') }}
                        </th>
                        <th>
                            Text
                        </th>
                        <th>
                            {{ trans('cruds.slider.fields.status') }}
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                @forelse ($categories as $row)
                        <tr>
                            <td>{{ $row->id ?? '' }}</td>
                            <td>
                                {{ $row->text }}
                            </td>
                            <td>
                                <?php echo ($row->status == 0)?'Inactive':'Active'; ?>
                            </td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('admin.htext.edit', $row->id) }}" title="{{ trans('global.edit') }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-danger" onclick="return confirm('{{ trans('global.areYouSure') }}');" href="{{ route('admin.htext.delete', $row->id) }}" title="{{ trans('global.delete') }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                No record found!
                            </td>
                        </tr>
                    @endforelse
            </table>
        </div>
    </div>



@endsection


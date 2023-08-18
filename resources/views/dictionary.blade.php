@extends('layouts.app')
@section('content')

    <link rel="stylesheet" href="{{ asset('css/dictionary.css') }}">
    <div class="card-body">
        <div class="row">
            <h3 id="tableNameId" class="text-center text-primary mb-4">{{ $tableName }} szótár</h3>
            <div class="col-md-12">
                <div style="overflow-x:auto;">
                    <table class="table table-hover table-info" id="worked">
                        <thead>
                            <tr>
                                <th style="min-width: 150px;">Angol szó</th>
                                <th style="min-width: 150px;">jelentése 1</th>
                                <th style="min-width: 150px;">jelentése 2</th>
                                <th style="min-width: 150px;">jelentése 3</th>
                                <th>
                                    <button type="button" class="btn btn-blue add-row header-button-color">+ új szó</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tableValues as $value)
                                <tr>
                                    <td>
                                        <input class="form-control" type="text" value="{{ $value['english'] }}" disabled>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" value="{{ $value['hungarian1'] }}"
                                            disabled>
                                    </td>
                                    <td>
                                        <input disabled class="form-control" type="text"
                                            value="{{ $value['hungarian2'] }}">
                                    </td>
                                    <td>
                                        <input disabled class="form-control" type="text"
                                            value="{{ $value['hungarian3'] }}">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger delete-row"
                                            style="margin-right: 10px">-</button>
                                        <button type="button" class="btn btn-primary edit-row" style="font-size: 15px">Szerkesztés</button>
                                        <button type="button" class="btn btn-success save-row"
                                            style="display: none;">Mentés</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/dictionary.js') }}" type="text/javascript">
        var tableName = "{{ $tableName }}";
    </script>
@endsection

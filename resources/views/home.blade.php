@extends('layouts.app')
@section('style')
<link href="{{ asset('paginate/simplePagination.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="clearfix">
        <span class="float-right "> Search: <input type="text" id="search" class="form-control-sm"></span>
        <select name="row_data" id="row_data" class="float-left">
            <option value="25">
                25
            </option>
            <option value="50">
                50
            </option>
        </select>

    </div>
    


    <div class="row">

        <table class="table table-striped" id="data_table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created_at</th>
                </tr>
            </thead>

            <tbody id="show_data">

            </tbody>

        </table>
</div>
    <div class="clearfix" >
            <div id="previous" ><a class="float-left" id="prv"> Previous </a></div> 
            <input type="hidden" name="prvurl" id="prvurl">

            <input type="hidden" name="nxturl" id="nxturl">
            <div id="next" ><a class="float-right" id="nxt"> Next </a></div>
        </div>
</div>

@endsection
@section('script')

<script type="text/javascript">
    $(document).ready(function() {
        var row_data = $('#row_data').val();

        $.ajax({
            url: 'ajax_list',
            type: "GET",
            data: {row_data: row_data},
            dataType: "json",
            success: function(data) {
                $('#nxturl').val(data.next_page_url);
                $("#nxt").attr("href", data.next_page_url);

                var html = '';
                console.log(data['data']);
                var l = data['data'].length;

                var i;

                for (i = 0; i < l; i++) {
                    html += '<tr>' +
                            '<td style="vertical-align: middle;">' + data['data'][i].id + '</td>' +
                            '<td style="vertical-align: middle;">' + data['data'][i].name + '</a></span> </td>' +
                            '<td style="vertical-align: middle;">' + data['data'][i].email + '</td>' +
                            '<td style="vertical-align: middle;">' + data['data'][i].created_at + '</td>' +
                            '</tr>';

                }
                $('#show_data').html(html);

                $('#prv').click(function(event) {
                    event.preventDefault();
                    var prvurl = $('#prvurl').val();

                    $.ajax({
                        url: prvurl,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $('#nxturl').val(response.next_page_url);
                            $('#prvurl').val(response.prev_page_url);
                            var nxtu = $('#nxturl').val();
                            var prvu = $('#prvurl').val();
                            $("#nxt").attr("href", nxtu);
                            $("#prv").attr("href", prvu);
                            var html = '';

                            var l = response['data'].length;
                            var i;

                            for (i = 0; i < l; i++) {
                                html += '<tr>' +
                                        '<td style="vertical-align: middle;">' + response['data'][i].id + '</td>' +
                                        '<td style="vertical-align: middle;">' + response['data'][i].name + '</a></span> </td>' +
                                        '<td style="vertical-align: middle;">' + response['data'][i].email + '</td>' +
                                        '<td style="vertical-align: middle;">' + response['data'][i].created_at + '</td>' +
                                        '</tr>';

                            }
                            $('#show_data').html(html);
                        }
                    });
                });

                $('#nxt').click(function(event) {
                    event.preventDefault();
                    var nxturl = $('#nxturl').val();

                    $.ajax({
                        url: nxturl,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            $('#nxturl').val(response.next_page_url);
                            $('#prvurl').val(response.prev_page_url);
                            var nxtu = $('#nxturl').val();
                            var prvu = $('#prvurl').val();
                            $("#nxt").attr("href", nxtu);
                            $("#prv").attr("href", prvu);
                            var html = '';

                            var l = response['data'].length;
                            var i;

                            for (i = 0; i < l; i++) {
                                html += '<tr>' +
                                        '<td style="vertical-align: middle;">' + response['data'][i].id + '</td>' +
                                        '<td style="vertical-align: middle;">' + response['data'][i].name + '</a></span> </td>' +
                                        '<td style="vertical-align: middle;">' + response['data'][i].email + '</td>' +
                                        '<td style="vertical-align: middle;">' + response['data'][i].created_at + '</td>' +
                                        '</tr>';

                            }
                            $('#show_data').html(html);
                        }

                    });
                });
            }
        });


        $("#search").keyup(function() {
            var value = this.value.toLowerCase().trim();

            $("table tr").each(function(index) {
                if (!index)
                    return;
                $(this).find("td").each(function() {
                    var id = $(this).text().toLowerCase().trim();
                    var not_found = (id.indexOf(value) == -1);
                    $(this).closest('tr').toggle(!not_found);
                    return not_found;
                });
            });
        });


        $("#row_data").on("change", function() {

            var selected = this.value;
            
            $.ajax({
                url: 'ajax_list',
                type: "GET",
                data: {row_data: selected},
                dataType: "json",
                success: function(response) {
                   
                   console.log(response);
                    $('#nxturl').val(response.next_page_url);
                    $('#prvurl').val(response.prev_page_url);
                    var nxtu = $('#nxturl').val();
                    var prvu = $('#prvurl').val();
                    $("#nxt").attr("href", nxtu);
                    $("#prv").attr("href", prvu);
                    var html = '';

                    var l = response['data'].length;
                    var i;

                    for (i = 0; i < l; i++) {
                        html += '<tr>' +
                                '<td style="vertical-align: middle;">' + response['data'][i].id + '</td>' +
                                '<td style="vertical-align: middle;">' + response['data'][i].name + '</a></span> </td>' +
                                '<td style="vertical-align: middle;">' + response['data'][i].email + '</td>' +
                                '<td style="vertical-align: middle;">' + response['data'][i].created_at + '</td>' +
                                '</tr>';

                    }
                    $('#show_data').html(html);
                }

            });

        });






    });



</script>
@endsection
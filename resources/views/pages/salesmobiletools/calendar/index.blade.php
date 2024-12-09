@extends('layouts.app')

@section('pageTitle','Event Schedule')

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Calendar</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    Extra pages
                </li>
                <li class="active">
                    <strong>Calendar </strong>
                </li>
            </ol>
        </div>
    </div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInDown">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Events for This Month</h5>

                </div>
                <div class="ibox-content">
                    <div id='external-events'>
                        <p>List of Events.</p>
                            @foreach($events as $event)
                             <div class='external-event navy-bg'>{{$event->title}}</div>
                            @endforeach

                        <p class="m-t">
                            <!--@if (!can('calendar.create'))
                                <a href="#" class="btn btn-warning btn-sm add-event">
                                    <i class="fa fa-plus">&nbsp;</i>Create Event
                                </a>
                            @endif-->
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-9">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Calendar - Schedule of Events</h5>
                </div>
                <div class="ibox-content">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pages.salesmobiletools.calendar.create')

@endsection


@section('scripts')

<link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<script src="/js/plugins/toastr/toastr.min.js"></script>

<!-- Mainly scripts -->
<script src="js/plugins/fullcalendar/moment.min.js"></script>

<!-- jQuery UI  -->
<script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>

<!-- Full Calendar -->
<script src="js/plugins/fullcalendar/fullcalendar.min.js"></script>

<script>

    $(document).ready(function() {
        $(function () {
              $("#start_date").datepicker();
        });
    });

    $(document).on('click', '.add-event', function() {
        $('.modal-title').text('Event Schedule');
        $('#eventModal').modal('show');
    });

    $(document).ready(function() {

        /* initialize the external events
         -----------------------------------------------------------------*/

        $('#external-events div.external-event').each(function() {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1111999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });


        /* initialize the calendar
         -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var _month = date.getMonth();

        



        $.ajax({
            url:  '{{ url('calendar-schedule/events') }}',
            type: 'POST',
            dataType: 'json',
            data: { _token: "{{ csrf_token() }}",
            month: _month}, 
            success:function(results){

                        
                $('#calendar').fullCalendar({
                    header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                selectable: true,
                selectHelper: true,
                select: function(start,end, allDays){
                    $('#eventModal').modal('toggle');
                        var start_date =moment(start).format('YYYY-MM-DD');
                        var end_date =moment(end).format('YYYY-MM-DD');
                 
                        $('#start_date').val(start_date);
                        $('#end_date').val(end_date);
                },
                events : 
                    [


                        {
                            title: 'Birthday Party',
                            start: new Date(y, m, d+1, 19, 0),
                            end: new Date(y, m, d+1, 22, 30),
                            allDay: false
                        },
                        {
                            title: 'Click for Google',
                            start: new Date(y, m, 28),
                            end: new Date(y, m, 29),
                            url: 'http://google.com/'
                        },
                    ]
            });  

            }
        });


    });

</script>
@endsection

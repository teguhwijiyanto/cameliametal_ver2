@extends('templates.default')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sticky-top mb-3">
                        @include('templates.partials.alerts')
                        {{-- Shift Lists --}}
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Machine</h4>
                            </div>
                            <div class="card-body">
                                <select name="" id="machine_selector" class="form-control">
                                    <option value="all">All</option>
                                    @foreach ($machines as $machine)
                                        <option value="{{$machine->id}}">{{$machine->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Shift Lists --}}
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Shift List</h4>
                            </div>
                            <div class="card-body">
                                <div id="external-events">
                                    @foreach ($shifts as $shift)
                                        <div class="external-event text-black" 
                                            style="background-color:{{ $shift->background_color }}" 
                                            id="{{$shift->id}}"><u>{{ $shift->name }}</u>
                                            <p class="text-white" style="margin:1px;">{{ date('H:i',strtotime($shift->start_time)) }} - {{ date('H:i',strtotime($shift->end_time)) }}</p>
                                            @if ($shift->break_1_start||$shift->break_1_end)
                                                <p class="text-sm" style="margin:1px;">Break 1: <em>{{ date('H:i',strtotime($shift->break_1_start)) }} - {{ date('H:i',strtotime($shift->break_1_end)) }}</em></p>
                                            @endif
                                            @if ($shift->break_2_start||$shift->break_2_end)
                                                <p class="text-sm" style="margin:1px;">Break 2: <em>{{ date('H:i',strtotime($shift->break_2_start)) }} - {{ date('H:i',strtotime($shift->break_2_end)) }}</em></p>
                                            @endif
                                            @if ($shift->break_3_start||$shift->break_3_end)
                                                <p class="text-sm" style="margin:1px;">Break 3: <em>{{ date('H:i',strtotime($shift->break_3_start)) }} - {{ date('H:i',strtotime($shift->break_3_end)) }}</em></p>
                                            @endif
                                            @if ($shift->break_4_start||$shift->break_4_end)
                                                <p class="text-sm" style="margin:1px;">Break 4: <em>{{ date('H:i',strtotime($shift->break_4_start)) }} - {{ date('H:i',strtotime($shift->break_4_end)) }}</em></p>
                                            @endif
                                            @if ($shift->break_5_start||$shift->break_5_end)
                                                <p class="text-sm" style="margin:1px;">Break 5: <em>{{ date('H:i',strtotime($shift->break_5_start)) }} - {{ date('H:i',strtotime($shift->break_5_end)) }}</em></p>
                                            @endif
                                            <a href="" class="shift-edit" id="{{$shift->id}}"><i class="fas fa-edit"></i>Edit</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- Create Event Display --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Create New Shift</h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label for="" class="input-label">Shift Name</label>
                                    <div class="input-group">
                                        <input id="" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" 
                                            placeholder="Name"
                                            disabled>
                                        @error('name')
                                            <span class="text-danger help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <label for="" class="input-label">Start Shift</label>
                                    <div class="input-group date" id="timepicker-start-shift" data-target-input="nearest">
                                        <input type="text" name="start_time"
                                            class="form-control datetimepicker-input @error('start_time') is-invalid @enderror"
                                            placeholder="Start Shift" data-target="#timepicker-start-shift" />
                                        <div class="input-group-append" data-target="#timepicker-start-shift"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                        @error('start_time')
                                            <span class="text-danger help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <label for="" class="input-label">End Shift</label>
                                    <div class="input-group date" id="timepicker-end-shift" data-target-input="nearest">
                                        <input type="text" name="end_time"
                                            class="form-control datetimepicker-input @error('end_time') is-invalid @enderror"
                                            placeholder="End Shift" data-target="#timepicker-end-shift" />
                                        <div class="input-group-append" data-target="#timepicker-end-shift"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                        @error('end_time')
                                            <span class="text-danger help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <label for="" class="input-label">Break 1</label>
                                    <div class="input-group">
                                        <div class="input-group date" id="timepicker-break-1-start"
                                            data-target-input="nearest">
                                            <input type="text" name="break_1_start"
                                                class="form-control datetimepicker-input" placeholder="Start"
                                                data-target="#timepicker-break-1-start" />
                                            <div class="input-group-append" data-target="#timepicker-break-1-start"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                        <div class="input-group date" id="timepicker-break-1-end"
                                            data-target-input="nearest">
                                            <input type="text" name="break_1_end"
                                                class="form-control datetimepicker-input" placeholder="End"
                                                data-target="#timepicker-break-1-end" />
                                            <div class="input-group-append" data-target="#timepicker-break-1-end"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="" class="input-label">Break 2</label>
                                    <div class="input-group">
                                        <div class="input-group date" id="timepicker-break-2-start"
                                            data-target-input="nearest">
                                            <input type="text" name="break_2_start"
                                                class="form-control datetimepicker-input" placeholder="Start"
                                                data-target="#timepicker-break-2-start" />
                                            <div class="input-group-append" data-target="#timepicker-break-2-start"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                        <div class="input-group date" id="timepicker-break-2-end"
                                            data-target-input="nearest">
                                            <input type="text" name="break_2_end"
                                                class="form-control datetimepicker-input" placeholder="End"
                                                data-target="#timepicker-break-2-end" />
                                            <div class="input-group-append" data-target="#timepicker-break-2-end"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="" class="input-label">Break 3</label>
                                    <div class="input-group">
                                        <div class="input-group date" id="timepicker-break-3-start"
                                            data-target-input="nearest">
                                            <input type="text" name="break_3_start"
                                                class="form-control datetimepicker-input" placeholder="Start"
                                                data-target="#timepicker-break-3-start" />
                                            <div class="input-group-append" data-target="#timepicker-break-3-start"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                        <div class="input-group date" id="timepicker-break-3-end"
                                            data-target-input="nearest">
                                            <input type="text" name="break_3_end"
                                                class="form-control datetimepicker-input" placeholder="End"
                                                data-target="#timepicker-break-3-end" />
                                            <div class="input-group-append" data-target="#timepicker-break-3-end"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="" class="input-label">Break 4</label>
                                    <div class="input-group">
                                        <div class="input-group date" id="timepicker-break-4-start"
                                            data-target-input="nearest">
                                            <input type="text" name="break_4_start"
                                                class="form-control datetimepicker-input" placeholder="Start"
                                                data-target="#timepicker-break-4-start" />
                                            <div class="input-group-append" data-target="#timepicker-break-4-start"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                        <div class="input-group date" id="timepicker-break-4-end"
                                            data-target-input="nearest">
                                            <input type="text" name="break_4_end"
                                                class="form-control datetimepicker-input" placeholder="End"
                                                data-target="#timepicker-break-4-end" />
                                            <div class="input-group-append" data-target="#timepicker-break-4-end"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="" class="input-label">Break 5</label>
                                    <div class="input-group">
                                        <div class="input-group date" id="timepicker-break-5-start"
                                            data-target-input="nearest">
                                            <input type="text" name="break_5_start"
                                                class="form-control datetimepicker-input" placeholder="Start"
                                                data-target="#timepicker-break-5-start" />
                                            <div class="input-group-append" data-target="#timepicker-break-5-start"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                        <div class="input-group date" id="timepicker-break-5-end"
                                            data-target-input="nearest">
                                            <input type="text" name="break_5_end"
                                                class="form-control datetimepicker-input" placeholder="End"
                                                data-target="#timepicker-break-5-end" />
                                            <div class="input-group-append" data-target="#timepicker-break-5-end"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <label for="">Background color</label>
                                    <input type="text" name="background_color" class="form-control"
                                        placeholder="Background" id="event-color" value="rgb(0, 86, 179)" hidden />
                                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                        <ul class="fc-color-picker" id="color-chooser">
                                            <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a>
                                            </li>
                                            <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a>
                                            </li>
                                            <li><a class="text-success" href="#"><i class="fas fa-square"></i></a>
                                            </li>
                                            <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a>
                                            </li>
                                            <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="input-group">
                                        <button id="add-new-event" type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <form action="" method="POST" id="deleteForm">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete" style="display:none">
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/main.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#timepicker-start-shift').datetimepicker({
            format: 'HH:mm'
        });
        $('#timepicker-end-shift').datetimepicker({
            format: 'HH:mm'
        });
        $('#timepicker-break-1-start').datetimepicker({
            format: 'HH:mm'
        });
        $('#timepicker-break-1-end').datetimepicker({
            format: 'HH:mm'
        });
        $('#timepicker-break-2-start').datetimepicker({
            format: 'HH:mm'
        });
        $('#timepicker-break-2-end').datetimepicker({
            format: 'HH:mm'
        });
        $('#timepicker-break-3-start').datetimepicker({
            format: 'HH:mm'
        });
        $('#timepicker-break-3-end').datetimepicker({
            format: 'HH:mm'
        });
        $('#timepicker-break-4-start').datetimepicker({
            format: 'HH:mm'
        });
        $('#timepicker-break-4-end').datetimepicker({
            format: 'HH:mm'
        });
        $('#timepicker-break-5-start').datetimepicker({
            format: 'HH:mm'
        });
        $('#timepicker-break-5-end').datetimepicker({
            format: 'HH:mm'
        });
    </script>
    <script>
        // Calendar Scripts
        $(function() {

            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function() {

                    // create an Event Object (https://fullcalendar.io/docs/event-object)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    }

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0 //  original position after the drag
                    })

                })
            }

            ini_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------

            new Draggable(containerEl, {
                itemSelector: '.external-event',
                // eventData: function(eventEl) {
                //     return {
                //         title: eventEl.innerText,
                //         backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                //         borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                //         textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                //     };
                // }
            });

            machine_select = $('#machine_selector').val();
            if ($('#machine_selector').val() == 'all') {
                machine_select = 0;
            }

            var calendar = new Calendar(calendarEl, {
                themeSystem: 'bootstrap',
                //Random default events
                businessHours:{
                    daysOfWeek:[1,2,3,4,5]
                },
                events: function(results){
                    return $.ajax({
                        url:'{{route('admin.schedule.data')}}',
                        type:'GET',
                        dataType:'json',
                        data:{
                            machine_id:$('#machine_selector').val()
                        },
                    });
                },
                editable: function(info){
                    console.log(info);
                },
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(info) {
                    // is the "remove after drop" checkbox checked?
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: '{{ route('admin.schedule.store') }}',
                        data:{
                          machine_id:machine_select,
                          shift_id:info.draggedEl.id,
                          start:info.dateStr,
                          end:info.dateStr,
                          _token: '{{csrf_token()}}'
                        },
                        success: function(data) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Success',
                                text: "New Shift Submitted Successfully",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error:function(data){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Failed',
                                text: "Submit Failed",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                    calendar.refetchEvents();
                },
                eventDrop:function(info){
                    var endString = info.event.endStr;
                    if (endString == '') {
                        endString = info.event.startStr;
                    }
                    Swal.fire({
                        title: 'Are you sure want to edit this shift?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Update it!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'PUT',
                                dataType: 'json',
                                url: window.location.origin + '/admin/schedule/'+ info.event.id,
                                data:{
                                    start:info.event.startStr,
                                    end:endString,
                                    _token: '{{csrf_token()}}'
                                },
                                success: function(data) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Success',
                                        text: "Shift Updated Successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                },
                                error:function(data){
                                    console.log(info);                                                                                                                              
                                    console.log(data.responseText);
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'Failed',
                                        text: "Update Process Failed",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            });
                            calendar.refetchEvents();
                        }
                    });
                    calendar.refetchEvents();
                },
                eventResize: function(info) {
                    Swal.fire({
                        title: 'Are you sure want to edit this shift?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Update it!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'PUT',
                                dataType: 'json',
                                url: window.location.origin + '/admin/schedule/'+ info.event.id,
                                data:{
                                    start:info.event.startStr,
                                    end:info.event.endStr,
                                    _token: '{{csrf_token()}}'
                                },
                                success: function(data) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Success',
                                        text: "Shift Updated Successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                },
                                error:function(data){
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'Failed',
                                        text: "Update Process Failed",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            });
                            calendar.refetchEvents();
                        }
                    });
                    calendar.refetchEvents();
                },
                eventClick: function(info) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'DELETE',
                                dataType: 'json',
                                url: window.location.origin + '/admin/schedule/'+ info.event.id,
                                data:{
                                _token: '{{csrf_token()}}'
                                },
                                success: function(data) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Success',
                                        text: "Shift Deleted Successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                },
                                error:function(data){
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'Failed',
                                        text: "Delete Process Failed",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            });
                            calendar.refetchEvents();
                        }
                    });
                    calendar.refetchEvents();
                }

            });
            calendar.render();

            /* ADDING EVENTS */
            var currColor = '#3c8dbc' //Red by default
            // Color chooser button
            $('#color-chooser > li > a').click(function(e) {
                e.preventDefault()
                // Save color
                currColor = $(this).css('color')
                // Add color effect to button
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color': currColor
                })
                $('#event-color').val(currColor);
            });

            $('#machine_selector').on('change',function(){
                calendar.refetchEvents();
                machine_select = $('#machine_selector').val();
                if ($('#machine_selector').val() == 'all') {
                    machine_select = 0;
                }
            });

            $('a.shift-edit').on('click',function(e){
                e.preventDefault();
                $.ajax({
                    url:window.location.origin + '/admin/shift/'+ e.currentTarget.id + '/edit',
                    type:'GET',
                    dataType:'json',
                    // data:{
                    //     id:e.currentTarget.id
                    // },
                    success:function(response){
                        var shiftData = response[0];
                        $('input[name="name"]').val(shiftData.name);
                        $('input[name="start_time"]').val(shiftData.start_time);
                        $('input[name="end_time"]').val(shiftData.end_time);
                        $('input[name="break_1_start"]').val(shiftData.break_1_start);
                        $('input[name="break_1_end"]').val(shiftData.break_1_end);
                        $('input[name="break_2_start"]').val(shiftData.break_2_start);
                        $('input[name="break_2_end"]').val(shiftData.break_2_end);
                        $('input[name="break_3_start"]').val(shiftData.break_3_start);
                        $('input[name="break_3_end"]').val(shiftData.break_3_end);
                        $('input[name="break_4_start"]').val(shiftData.break_4_start);
                        $('input[name="break_4_end"]').val(shiftData.break_4_end);
                        $('input[name="break_5_start"]').val(shiftData.break_5_start);
                        $('input[name="break_5_end"]').val(shiftData.break_5_end);
                    }
                })
                // console.log(e.currentTarget.id);
            })
        });
        
    </script>
@endpush

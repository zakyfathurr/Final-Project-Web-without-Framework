<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
    
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
            <p class="text-center"><b>Data Bookings</b></p>
              <table class="table table-striped" border="1">
                <thead class="thead-dark" >
                  <tr class="text-center">
                    <th scope="col">Room ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Room Name</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Check In Date</th>
                    <th scope="col">Check Out Date</th>
                    <th scope="col">Action</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $data)
                  <tr class="text-center">
                    <td scope="row">{{ $data->room->room_id}}</td>
                    <td scope="row">
                      <img src="room/{{ $data->room->image }}" alt="Room Image" style="width: 130px; height: auto;" />
                    </td>
                    <td scope="row">{{ $data->room->room_title }}</td>
                    <td scope="row">{{ $data->name }} </td>
                    <td scope="row">{{ $data->email }}</td>
                    <td scope="row">{{ $data->phone }}</td>
                    <td scope="row">{{$data->checkIn}}</td>
                    <td scope="row">{{$data->checkOut}}</td>
                    <td scopre="row" style="text-align:center">
                        <a onclick="return confirm('Are you sure to delete this?');" class="btn btn-danger"  href="{{url('delete_booking',$data->id)}}">Delete</a><br></br>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </div>


    @include('admin.footer')
  </body>
</html>
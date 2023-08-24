<!doctype html>
<html lang="en">

<head>
    <title>Students Report</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

    <div class="container" style="position: relative">
        <div class="logo my-3" style="text-align:center">
            <img src="https://portal.staybright.in/assets/images/brand/logo-3.png" alt="">
        </div>
        <h4 class="text-center my-3">Students Report</h4>
        @if(count($users)>0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    @if (in_array('Username', $columns))
                        <th>Username</th>
                    @endif
                    @if (in_array('Email', $columns))
                        <th>Email</th>
                    @endif
                    @if (in_array('Mobile', $columns))
                        <th>Mobile</th>
                    @endif
                    @if (in_array('Password', $columns))
                        <th>Password</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                @php
                    $more = DB::table('user_more')->where('user_id',$user->id)->first();
                @endphp
                <tr>
                    @if (in_array('Username', $columns))
                        <td>{{ $user->username }}</td>
                    @endif
                    @if (in_array('Email', $columns))
                        <td>{{ $user->email }}</td>
                    @endif
                    @if (in_array('Mobile', $columns))
                        <td>{{ $user->mobile }}</td>
                    @endif
                    @if (in_array('Password', $columns))
                        <td>{{ $more->open_password }}</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p class="text-center">No Data Found</p>
        @endif

        <div class="note" style="position: absolute;bottom:1%;text-align:center">This is a system generated report. So
            no need to verify.</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>

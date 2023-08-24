<!doctype html>
<html lang="en">

<head>
    <title>Enquiry Report</title>
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
        <h4 class="text-center my-3">Enquiry Report</h4>
        <div class="card">
            <div class="card-body">
                <div>Branch</div>
                <div class="mb-4"><strong>{{$e->branch}}</strong></div>
                <div>Type</div>
                <div class="mb-4"><strong>{{strtoupper($e->type)}}</strong></div>
                <div>Name</div>
                <div class="mb-4"><strong>{{$e->name}}</strong></div>
                <div>Email</div>
                <div class="mb-4"><strong>{{$e->email}}</strong></div>
                <div>Mobile</div>
                <div class="mb-4"><strong>{{$e->mobile}}</strong></div>
                <div>Address</div>
                <div class="mb-4"><strong>{{$e->full_address}}</strong></div>

                <div>10th</div>
                <div class="mb-4"><strong>{{$e->tenth_name}}</strong></div>
                <div>10th start</div>
                <div class="mb-4"><strong>{{$e->tenth_start}}</strong></div>
                <div>10th end</div>
                <div class="mb-4"><strong>{{$e->tenth_end}}</strong></div>
                <div>10th percent</div>
                <div class="mb-4"><strong>{{$e->tenth_percent}}</strong></div>

                <div>12th</div>
                <div class="mb-4"><strong>{{$e->twlefth_name}}</strong></div>
                <div>12th start</div>
                <div class="mb-4"><strong>{{$e->twlefth_start}}</strong></div>
                <div>12th end</div>
                <div class="mb-4"><strong>{{$e->twlefth_end}}</strong></div>
                <div>12th percent</div>
                <div class="mb-4"><strong>{{$e->twlefth_percent}}</strong></div>
               
                <div>Bachelors</div>
                <div class="mb-4"><strong>{{$e->bachelor_name}}</strong></div>
                <div>Bachelors start</div>
                <div class="mb-4"><strong>{{$e->bachelor_start}}</strong></div>
                <div>Bachelors end</div>
                <div class="mb-4"><strong>{{$e->bachelor_end}}</strong></div>
                <div>Bachelors percent</div>
                <div class="mb-4"><strong>{{$e->bachelor_percent}}</strong></div>
               
                <div>Masters</div>
                <div class="mb-4"><strong>{{$e->master_name}}</strong></div>
                <div>Bachelors start</div>
                <div class="mb-4"><strong>{{$e->master_start}}</strong></div>
                <div>Bachelors end</div>
                <div class="mb-4"><strong>{{$e->master_end}}</strong></div>
                <div>Bachelors percent</div>
                <div class="mb-4"><strong>{{$e->master_percent}}</strong></div>
               
                <div>Diploma</div>
                <div class="mb-4"><strong>{{$e->diploma_name}}</strong></div>
                <div>Diploma start</div>
                <div class="mb-4"><strong>{{$e->diploma_start}}</strong></div>
                <div>Diploma end</div>
                <div class="mb-4"><strong>{{$e->diploma_end}}</strong></div>
                <div>Diploma percent</div>
                <div class="mb-4"><strong>{{$e->diploma_percent}}</strong></div>

                <div>Country of interest</div>
                <div class="mb-4"><strong>{{$e->country_of_interest}}</strong></div>
                <div>Course of interest</div>
                <div class="mb-4"><strong>{{$e->course_of_interest}}</strong></div>
                <div>Field of interest</div>
                <div class="mb-4"><strong>{{$e->field_of_interest}}</strong></div>
                <div>Preferred location</div>
                <div class="mb-4"><strong>{{$e->preferred_location}}</strong></div>
                <div>Intake</div>
                <div class="mb-4"><strong>{{$e->intake}}</strong></div>
                <div>Done IELTS or PTE?</div>
                <div class="mb-4"><strong>{{strtoupper($e->done_ielts_or_pte)}}</strong></div>
                @if($e->done_ielts_or_pte!='nothing')
                <div>Overall</div>
                <div class="mb-4"><strong>{{$e->overall}}</strong></div>
                <div>Listening</div>
                <div class="mb-4"><strong>{{$e->listening}}</strong></div>
                <div>Reading</div>
                <div class="mb-4"><strong>{{$e->reading}}</strong></div>
                <div>Writing</div>
                <div class="mb-4"><strong>{{$e->writing}}</strong></div>
                <div>Speaking</div>
                <div class="mb-4"><strong>{{$e->speaking}}</strong></div>
                @endif
               
            </div>
        </div>
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

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>IControl</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh">
                <div class="col-8" style="min-height: 200px">
                    <form class="row" method="post">
                        {{csrf_field()}}
                        <div class="col-6">
                            <label for="exampleFormControlInput1" class="form-label">Start Time</label>
                            <input type="datetime-local" name="start-time" class="form-control" id="exampleFormControlInput1" required>
                        </div>
                        <div class="col-6">
                            <label for="exampleFormControlInput2" class="form-label">End Time</label>
                            <input type="datetime-local" name="end-time" class="form-control" id="exampleFormControlInput2" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label for="exampleFormControlInput1" class="form-label">Step</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="step" placeholder="Step" required>
                                <span class="input-group-text">minutes</span>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary mb-3">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

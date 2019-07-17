<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <div class="row d-flex justify-content-center">
        <div class="col-xs-6">
            <div>
                <h1>Teste Uello</h1>
            </div>
            <form method="POST" action="/saveCsv" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="FormControlFile">Upload CSV</label>
                    <input 
                        type="file"
                        accept=".csv, application/vnd.ms-excel"
                        name="upload"
                        class="form-control-file"
                        id="FormControlFile"
                    />
                </div>
                <div class="row d-flex justify-content-around">
                    <div class="col-xs-3 form-group">
                        <input 
                            type="submit"
                            class="form-control-submit"
                            id="FormControlSubmit"
                            value="Enviar CSV"
                        />
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
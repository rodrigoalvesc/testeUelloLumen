<html>

<head>
    <title>Ordem de Entrega</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="row justify-content-center">
        <div class="col-xs-6">
            <h1>Ordem de entregas</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xs-6">
            <h4>Endereço de Partida: Avenida Dr. Gastão Vidigal, 1132 - Vila Leopoldina - 05314-010</h4>
        </div>
    </div>
    <table class="table" id="table">
        <thead>
            <tr>
                <th scope="col">
                    Nome
                </th>
                <th scope="col">
                    Endereço
                </th>
                <th scope="col">
                    Cidade
                </th>
                <th scope="col">
                    Distancia do Endereço Anterior
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ordem as $cliente) : ?>
                <tr>
                    <td>
                        <?php echo $cliente->nome; ?>
                    </td>
                    <td>
                        <?php echo $cliente->logradouro . ", " . $cliente->numero . " " . $cliente->complemento . "- " . $cliente->bairro . " - " . $cliente->cep; ?>
                    </td>
                    <td>
                        <?php echo $cliente->cidade; ?>
                    </td>
                    <td>
                        <?php echo number_format($cliente->distancia, 2, ',', '.') . ' KM'; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
<script>
   function toCsv(){
        let data = this.getDataGrid();

        let csvContent = "data:text/csv;charset=utf-8," 
            + data.map(e => e.join(";")).join("\n");
        
        let encodedUri = encodeURI(csvContent);
        let link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "grid.csv");
        document.body.appendChild(link);

        link.click();
    }

    function getDataGrid(){
        let table = document.getElementById('table');
        return [...table.rows].map(t => [...t.children].map(u => u.innerText));
    }
</script>
</html>
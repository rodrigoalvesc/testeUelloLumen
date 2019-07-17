<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="row justify-content-center">
        <div class="col-xs-6">
            <h1>Dados Adicionados no Banco</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xs-6">
            <form action="/entrega">
                <input type="submit" value="Logica de Entrega" style="margin-bottom: 10px;"/>
            </form>
        </div>
        <div class="col-xs-6">
            <input type="button" value="Csv" style="margin: 0 0 10px 5px;" onclick="toCsv()"/>
        </div>

    </div>
    <table class="table" id="table">
        <thead>
            <tr>
                <th scope="col">
                    Nome
                </th>
                <th scope="col">
                    Email
                </th>
                <th scope="col">
                    Data de Nasc
                </th>
                <th scope="col">
                    CPF
                </th>
                <th scope="col">
                    Logradouro
                </th>
                <th scope="col">
                    Numero
                </th>
                <th scope="col">
                    Complemento
                </th>
                <th scope="col">
                    Bairro
                </th>
                <th scope="col">
                    Cidade
                </th>
                <th scope="col">
                    CEP
                </th>
                <th scope="col">
                    Lat
                </th>
                <th scope="col">
                    Long
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($csv as $cliente) : ?>
                <tr>
                    <td>
                        <?php echo $cliente['nome']; ?>
                    </td>
                    <td>
                        <?php echo $cliente['email']; ?>
                    </td>
                    <td>
                        <?php echo $cliente['datanasc']; ?>
                    </td>
                    <td>
                        <?php echo $cliente['cpf']; ?>
                    </td>
                    <td>
                        <?php echo $cliente['endereco']['logradouro']; ?>
                    </td>
                    <td>
                        <?php echo $cliente['endereco']['numero']; ?>
                    </td>
                    <td>
                        <?php echo $cliente['endereco']['complemento']; ?>
                    </td>
                    <td>
                        <?php echo $cliente['endereco']['bairro']; ?>
                    </td>
                    <td>
                        <?php echo $cliente['endereco']['cidade']; ?>
                    </td>
                    <td>
                        <?php echo $cliente['cep']; ?>
                    </td>
                    <td>
                        <?php echo $cliente['endereco']['lat']; ?>
                    </td>
                    <td>
                        <?php echo $cliente['endereco']['long']; ?>
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
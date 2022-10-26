<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Crud</title>
    <style>
        .bbb{
            background-image: url('./assets/back2.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position-y: center;
            background-attachment: fixed;
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            height: auto;
            min-height: 100vh;
        }

        label{
            color: whitesmoke;
        }
    </style>
</head>

<body class="bbb">
<div class="container pt-5">
    <form action="table_controller.php" method="POST" class="mt-5">




        <!-- ==== Columns table ==== -->
        <div class="row mt-4">
            <div class="col-md-8 offset-2 mb-5">

                <div class="col-md-12 ms-2">
                    <label for="table" class="form-label">MySql table</label>
                    <input required placeholder="table name" type="text" name="table" id="table" class="form-control">
                </div>

                <table class="table table-responsive-md table-borderless">
                    <thead>
                    <tr>
                        <th class="text-white" >Column name</th>
                        <th class="text-white" >Type</th>
                        <th class="text-white" >Size</th>
                        <th class="text-white" >Action</th>
                    </tr>
                    </thead>
                    <tbody class="main-table">

                    <tr>
                        <td>
                            <input value="" required type="text" class="form-control" name="column_name1" id="column_name1" placeholder="name">
                        </td>
                        <td>
                            <select onchange="change(this)" required class="form-control" name="type1" id="type1">
                                <option>text</option>
                                <option>varchar</option>
                                <option>integer</option>
                                <option>image</option>
                            </select>
                        </td>
                        <td>
                            <input required type="number" class="form-control" name="size1" id="size1" placeholder="space size">
                        </td>
                        <td>
                            <button onclick="deleteRow(this)" class="btn btn-danger">—</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <button onclick="addColumn()" type="button" class="btn btn-warning mb-5 ms-2">Add Column</button>
                <button type="submit" class="btn btn-primary mb-5">Submit</button>

            </div>
        </div>
    </form>
</div>





<script>

    let n = 2;


    function addColumn() {
        let form5 = document.querySelector('.main-table');


        let str6 = `<tr>
                    <td>
                        <input required value="" type="text" class="form-control" name="column_name${n}" id="column_name${n}" placeholder="name">
                    </td>
                    <td>
                        <select onchange="change(this)" required class="form-control" name="type${n}" id="type${n}">
                                        <option value="text">text</option>
                                        <option value="varchar">varchar</option>
                                        <option value="integer">integer</option>
                                        <option>image</option>
                                    </select>
                    </td>
                    <td>
                        <input required type="number" class="form-control" name="size${n}" id="size${n}" placeholder="space size">
                    </td>
                    <td>
                        <button onclick="deleteRow(this)" class="btn btn-danger">—</button>
                    </td>
                </tr>`;

        n++;
        form5.innerHTML += str6;
    }

    function deleteRow(data) {
        data.parentElement.parentElement.remove()
    }


    function change(type){
        let name =  type.parentElement.parentElement.childNodes[1].childNodes[1]
        let size = type.parentElement.parentElement.childNodes[5].childNodes[1]
        if (type.value == 'image'){
            name.value = 'image';
            size.value = 255;

            name.setAttribute('readonly', 'readonly')
            size.setAttribute('readonly', 'readonly')
        }else {
            size.removeAttribute("readonly");
            name.removeAttribute("readonly");
            name.value = ''
            size.value = ''
        }

        if (type.value == 'varchar'){
            size.value = 255;
            size.setAttribute('readonly', 'readonly')
        }
        if (type.value == 'integer'){
            size.value = 255;
            size.setAttribute('readonly', 'readonly')
        }

        if(type.value == 'text') {
            if (size.hasAttribute('readonly')) {
                size.removeAttribute("readonly");
                name.removeAttribute("readonly");
                name.value = ''
                size.value = ''
            }
        }





    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
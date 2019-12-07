<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="author" content="colorlib.com" />
  <link href="https://fonts.googleapis.com/css?family=Lato:400,600,700" rel="stylesheet" />
  <link href="{{ asset('css/main2.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,500,700'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js">
  </script>
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
</head>

<body>
  <div class="s009">
    <form>
      <div class="inner-form">
        <div class="advance-search">
          <span class="desc" style="text-align: center;">PHÒNG TRỌ PHÙ HỢP</span>
          <table class="table">
            <thead class="table-title">
              <tr>
                <!-- <th scope="col" style="text-align: center;">STT</th> -->
                <th scope="col" style="text-align: center;">Tiều đề</th>
                <th scope="col" style="text-align: center;">Mức giá</th>
                <th scope="col" style="text-align: center;">Diện tích </th>
                <th scope="col" style="text-align: center;">Địa chỉ</th>
                <!-- <th scope="col" style="text-align: center;">Tiện ích</th> -->
                <th scope="col" style="text-align: center;">Mô tả</th>
                <!-- <th scope="col" style="text-align: center;">Xếp hạng</th> -->
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </form>

  </div>
  <script src="{{ asset('js/extention/choices.js') }}"></script>
  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <script src="./script.js"></script>
  <script>
    const customSelects = document.querySelectorAll("select");
    const deleteBtn = document.getElementById("delete");
    const choices = new Choices("select", {
      searchEnabled: false,
      itemSelectText: "",
      removeItemButton: true
    });
    deleteBtn.addEventListener("click", function (e) {
      e.preventDefault();
      const deleteAll = document.querySelectorAll(".choices__button");
      for (let i = 0; i < deleteAll.length; i++) {
        deleteAll[i].click();
      }
    });
  </script>
</body>
<!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
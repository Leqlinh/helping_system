<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="author" content="colorlib.com" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,600,700" rel="stylesheet" />
  <link href="{{ asset('css/main.css') }}" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,500,700'>
  <!-- <link rel="stylesheet" href="{{ asset('css/style-checkbox.css') }}"> -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>


<body>

  <div class="s009">
    <form id="helping_system">
      <div class="inner-form">
        <div class="advance-search">
          <span class="desc" style="text-align: center;">HỆ TRỢ GIÚP TÌM PHÒNG TRỌ</span>
          <div class="row">
            <div class="input-field">
              <div class="input-select">
                <select data-trigger="" name="acreage">
                  <option placeholder="" value="">Diện tích</option>
                  <option value="1"> 1. Diện tích : < 15 m2</option> 
                  <option value="2"> 2. Diện tích : 15 - 20 m2</option>
                  <option value="3"> 3. Diện tích : 20 - 25 m2</option>
                  <option value="4"> 4. Diện tích : 25 - 30 m2</option>
                  <option value="5"> 5. Diện tích : > 30 m2</option>
                </select>
              </div>
            </div>
            <div class="input-field">
              <div class="input-select">
                <select data-trigger="" name="price">
                  <option placeholder="" value="">Mức giá</option>
                  <option value="5"> 1. Mức giá : < 1 triệu</option> 
                  <option value="4"> 2. Mức giá : 1 - 2 triệu</option>
                  <option value="3"> 3. Mức giá : 2 - 3 triệu</option>
                  <option value="2"> 4. Mức giá : 3 - 5 triệu</option>
                  <option value="1"> 5. Mức giá : > 5 triệu  </option>
                </select>
              </div>
            </div>
            <div class="input-field">
              <div class="input-select">
                <select data-trigger="" name="address">
                  <option placeholder="" value="">Địa điểm</option>
                  <option value="Ba Đình"> Ba Đình</option>
                  <option value="Hoàn Kiếm"> Hoàn Kiếm</option>
                  <option value="Cầu Giấy"> Cầu Giấy</option>on
                  <option value="Đống Đa"> Đống Đa </option>
                  <option value="Hai Bà Trưng"> Hai Bà Trưng</option>
                  <option value="Hoàng Mai"> Hoàng Mai</option>
                  <option value="Thanh Xuân"> Thanh Xuân</option>
                  <option value="Hà Đông"> Hà Đông</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row second">
            <div class="input-field2">
              <div class="input-select">
                <select placeholder="Tiện ích phụ" name="utilities" multiple="multiple">
                  <option value="wifi">Wifi</option>
                  <option value="heater">Nóng lạnh</option>
                  <option value="air_conditioner">Điều hòa</option>
                  <option value="chung_chu">Chung chủ</option>

                </select>
              </div>
            </div>

          </div>
          <div class="row third">
            <div class="input-field">

              <div class="group-btn" style="margin-left: auto; margin-right: auto;">
                <button class="btn-delete" id="delete">RESET</button>
              <!--   <button class="btn-search"><a href="/result">Result</a></button> -->
                <a class="btn-search" id="submit" style="height: 100px;">SEARCH</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

  </div>

  <div class="s009">
    <form>
      <div class="inner-form">
        <div class="advance-search">
          <span class="desc" style="text-align: center;">PHÒNG TRỌ PHÙ HỢP</span>
          <table class="table" id="table">
            <thead class="table-title">
              <tr>
                <th scope="col" style="text-align: center;">ID</th>
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
  <script src="{{ asset('js/script.js') }}"></script>
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
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#submit').click(function() {
      $.ajax({
        url: '/result',
        method: 'POST',
        dataType: 'json',
        data: {
          acreage : $("select[name='acreage']").val(),
          price : $("select[name='price']").val(),
          address : $("select[name='address']").val(),
          utilities : $("select[name='utilities']").val(),
        },
        success: function(data){
          for(i=0; i<data.length; i++){
            $('tbody').append("<tr><td>" + data[i]['id'] + "</td><td>" + data[i]['title'] + "</td><td>" + data[i]['price'] + "</td><td>" + data[i]['acreage'] + "</td><td>" + data[i]['area'] + "</td><td>" + data[i]['description'] + "</td></tr>")
          }
        },
      });
    })
  </script>
</body>
<!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
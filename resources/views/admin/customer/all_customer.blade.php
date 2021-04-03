@extends("admin.redirect")
@section("content")

<script>
function getRoom(idRoom) {      
    const newAjax = $.ajax({
        type: 'GET',
        cache: false,
        url: "{{ route('customer.get.room.for.customer') }}",
        data: {
            "_token": '{{ csrf_token() }}'
        },
        success: function(data) {
            // console.log(data);
            $.each(data['data'], function(index, value) {
                globalKH = data['data'];
                // console.log(globalTaikhoan);
                const Selected = idRoom && idRoom == value['id'] ? 'selected' : '';
                var option_room = $("<option " + Selected + " data-city='" + value["id"] + "' value='" +
                    value["id"] + "' id=" + value["id"] + " >" + value["id"] + "</option>");
                //alert(ac);    
                option_room.appendTo(".id-room");
            });
        },
        error: function(accounts) {
            console.log('Lỗi...');
        }
    });
    return newAjax;
}
$(document).ready(function () {
    // nếu click vào button thêm sẽ hiển thị button thêm ở dưới modal và ẩn button edit 
    $(".add_customer").click(function() {
        isAdded = true;
        $("#add").show();
        $("#edit").hide();
    })
    // ngược lại
    $(".edit_customer").click(function() { // muốn tìm kiếm nhanh dung ctrol + d nhé à mà phải bôi đen
        isAdded = false;
        $("#add").hide();
        $("#edit").show();
    })
    //select2 
    function formatResultMulti(data) {
        var city = $(data.element).data('city');
        var classAttr = $(data.element).attr('class');
        var hasClass = typeof classAttr != 'undefined';
        classAttr = hasClass ? ' ' + classAttr : '';
        var $result = $(
            '<div class="row">' +
            '<div class="col-md-6 col-xs-6' + classAttr + '">' + data.text + '</div>' +
            '<div class="col-md-6 col-xs-6' + classAttr + '">' + city + '</div>' +
            '</div>'
        );
        return $result;
    }
    //
    $('.selector').select2({
        width: '100%',
        formatResult: formatResultMulti
    });
    $('.addCustomer').on('show.bs.modal', function(event) {
        if (isAdded) {
            modal = $(this);
            $('.remove-Invalid').removeClass('is-invalid');
            $('.remove-Invalid').removeClass('border-invalid');
            $('.validation-danger').removeClass('alert-danger');
            $('.remove-border').removeClass('Invalid-border');
            $('.validation-danger').addClass('d-none');
            // modal.find(".selector").select2('val', '');
            $('.form-control').val('');
            modal.find(".selector").select2().val('').trigger("change");

        }
    });

    $('.editCustomer').on('show.bs.modal', function(event) { // modal có class là editCustomer
        if (isAdded) {
            return;
        }
        // mấy cái thông báo lỗi
        $('.remove-Invalid').removeClass('is-invalid');
        $('.remove-Invalid').removeClass('border-invalid');
        $('.validation-danger').removeClass('alert-danger');
        $('.remove-border').removeClass('Invalid-border');
        $('.validation-danger').addClass('d-none');
        //
        id = $(event.relatedTarget).attr('data_id'); //lấy id của khách hàng cần edit
        modal = $(this);
        $.ajax({
            type: 'GET',
            cache: false,
            url: "{{ route('customer.get.id.customer') }}",
            data: {
                "_token": '{{ csrf_token() }}',
                "id": id
            },
            success: function(data) {
                console.log(data);
                var date_of_birth = moment(data["data"]["date_of_birth"]).format('YYYY-MM-DD');

                var room = data["data_room"]["room_id"];
                // var ngayketthuc = moment(data["data"]["ngayketthuc"]).format('YYYY-MM-DD');
                // var tienngoaite = Number(data["data"]["tienngoaite"]);
                // var thuengoaite = Number(data["data"]["thuengoaite"]);
                // var tienvnd = Number(data["data"]["tienvnd"]);
                // var thuevnd = Number(data["data"]["thuevnd"]);

                modal.find("#id_edit").val(data["data"]["id"]); //lấy id,name... câu truy vấn trả về
                modal.find("#name").val(data["data"]["name"]);
                modal.find("#id_card").val(data["data"]["id_card"]);
                modal.find("#job").val(data["data"]["job"]);
                modal.find("#address").val(data["data"]["address"]);
                modal.find("#date_of_birth").val(date_of_birth);
                modal.find("#room_id").select2().val(data["data_room"][0]["room_id"]).trigger("change");
            },
            error: function(data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    })

})
</script>

<div class="page-wrapper">

    <!-- start page container -->
    <div class="page-content">

        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">All Staffs</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="">Staffs</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <!-- <li class="active">All Staffs</li> -->
                </ol>
            </div>
        </div>
        <ul class="nav nav-pills nav-pills-rose">
            <li class="nav-item tab-all"><a data-toggle="modal" data-target=".addCustomer"
                    class="add_customer btn btn-success waves-effect waves-success mb-3">
                    <i class="fa fa-plus-square">
                    </i> Thêm mới
                </a></li>
        </ul>
        <div class="tab-content tab-space">
            <div class="tab-pane active show" id="tab1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <div class="card-head">
                                <button id="panel-button" class="mdl-button mdl-js-button mdl-button--icon pull-right"
                                    data-upgraded=",MaterialButton">
                                    <i class="material-icons">more_vert</i>
                                </button>
                                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                                    data-mdl-for="panel-button">
                                    <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action</li>
                                    <li class="mdl-menu__item"><i class="material-icons">print</i>Another action
                                    </li>
                                    <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something
                                        else here</li>
                                </ul>
                            </div>
                            <div class="card-body ">
                                <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width"
                                        id="example4">
                                        <!-- <div class="row">
                                            <div class=" col-sm-12 col-md-6">
                                                <form class="search-form-opened" action="#" method="GET">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="Search..."
                                                            name="query">
                                                        <span class="input-group-btn search-btn">
                                                            <a href="javascript:;" class="btn submit">
                                                                <i class="icon-magnifier"></i>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </form>
                                            </div>

                                        </div> -->
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th class="center"> HO VA TEN </th>
                                                <th class="center"> CMT </th>
                                                <th class="center"> NGAY SINH </th>
                                                <th class="center"> NGHE NGHIEP </th>
                                                <th class="center"> DIA CHI </th>
                                                <th class="center">NGAY THEM</th>
                                                <th class="center"> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($list as $item)
                                            <tr class="odd gradeX">
                                                <td class="user-circle-img sorting_1">
                                                    {{$item->id}}
                                                </td>
                                                <td class="center">{{$item->name}}</td>
                                                <td class="center">{{$item->id_card}}</td>
                                                <td class="center">{{$item->date_of_birth}}</td>
                                                <td class="center">{{$item->job}}</td>
                                                <td class="center">{{$item->address}}</td>
                                                <td class="center">{{$item->created_at}}</td>
                                                <td class="center">
                                                    <a data-target=".editCustomer" data-toggle="modal"
                                                        class="btn btn-xs  btn-warning edit_customer"
                                                        data-original-title="Sửa" data_id="{{$item->id}}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="center"><a href='{{URL::asset("customer/delete/$item->id")}}'
                                                        data-toggle="tooltip"
                                                        onclick="return confirm('Xoá khách hàng {{$item->name}}?')"
                                                        title="" class="btn btn-xs btn-danger delete-confirm"
                                                        data-original-title="Xoá"><i class="fa fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("admin.customer.add_customer")
    <!-- end footer -->
</div>
@endsection
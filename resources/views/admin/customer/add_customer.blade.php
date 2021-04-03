{{-- <script src="{{asset("phong-tro-theme/theme/light/assets/plugins/jquery/jquery.min.js")}}"></script> --}}
<script>
    getRoom();
</script>
<div class="modal fade in addCustomer editCustomer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg ui-draggable" role="document" style="max-width:1300px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Khách hàng</h5>
                <i class="fa fa-times" data-dismiss="modal" aria-hidden="true"
                    title="Đóng popup"></i>
            </div>
            <div class="modal-body">
                <form id="createForm" class="outer-repeater needs-validation" method="POST" novalidate
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_edit" name="id_edit">
                    <div data-repeater-list="outer-group" class="outer">
                        <div data-repeater-item class="outer">
                            <div class="form-group row">
                                <label for="" class="col-form-label col-lg-2">Tên khách hàng</label>
                                <div class="col-lg-10">
                                    <input id="name" name="name" type="text" value="{{old('name')}}"
                                        class="form-control remove-Invalid" placeholder="Nhập tên khách hàng..."
                                        required maxlength="100">
                                    <div class="invalid-feedback"><em></em> Tên khách hàng không hợp lệ</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-form-label col-lg-2">Số CMTND/ Thẻ căn cước</label>
                                <div class="col-lg-10">
                                    <input id="id_card" name="id_card" type="number" value="{{old('id_card')}}"
                                        class="form-control remove-Invalid" placeholder="Nhập số CMTND/ Thẻ căn cước..."
                                        required maxlength="100">
                                    <div class="invalid-feedback"><em></em> Số CMTND/ Thẻ căn cước không hợp lệ</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-form-label col-lg-2">Ngày sinh</label>
                                <div class="col-lg-10">
                                    <input id="date_of_birth" name="date_of_birth" type="date"
                                        value="{{old('date_of_birthđay')}}" class="form-control remove-Invalid"
                                        placeholder="Nhập ngày sinh..." required maxlength="100">
                                    <div class="invalid-feedback"><em></em> Ngày sinh không hợp lệ</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-form-label col-lg-2">Công việc hiện tại</label>
                                <div class="col-lg-10">
                                    <input id="job" name="job" type="text" value="{{old('job')}}"
                                        class="form-control remove-Invalid" placeholder="Nhập công việc hiện tại..."
                                        required maxlength="100">
                                    <div class="invalid-feedback"><em></em> Công việc không hợp lệ</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-form-label col-lg-2">Địa chỉ</label>
                                <div class="col-lg-10">
                                    <input id="address" name="address" type="text" value="{{old('address')}}"
                                        class="form-control remove-Invalid" placeholder="Nhập địa chỉ..." required
                                        maxlength="100">
                                    <div class="invalid-feedback"><em></em> Địa chỉ không hợp lệ</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="room" class="col-form-label col-lg-2">Phòng</label>
                                <div class="col-lg-10">
                                    <select name="room_id" id="room_id"
                                        class="selectedroom_id selector room_id-border remove-border" >
                                        <option value="">--</option>
                                        <optgroup class="id-room" label='Mã' data-city='Tên'>
                                        </optgroup>
                                    </select>
                                    <div class="invalid-feedback"><em></em> Phòng không hợp lệ</div>
                                </div>
                                {{-- <div class="col-lg-10 room_c">
                                    <select name="room_id" id="room_id"
                                        class="room_id-border remove-border form-group" >
                                        <option value="">--</option>
                                        @foreach($rooms as $room)
                                            <option value="{{$room->id}}">{{$room->id}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"><em></em> Phòng không hợp lệ</div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-12 cancel">
                            <button type="submit" id="add" class="btn btn-primary"><i class="fa fa-plus-square"></i>
                                Thêm Mới
                            </button>
                            <button type="submit" id="edit" class="btn btn-primary">
                                <i class="fa fa-plus-square"></i>
                                Cập Nhật
                            </button>
                            <input class="btn btn-danger" type="button" value="Hủy bỏ" onclick="">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
<script>
(function() {
    'use strict';
    window.addEventListener('load', function() {

        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {

            form.addEventListener('submit', function(event) {

                event.preventDefault();
                event.stopPropagation();

                if (form.checkValidity() === true) {

                    var data = new FormData(this);

                    if (isAdded) {
                        addCustomer(data);
                    } else {
                        editCustomer(data);
                    }
                }

                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

function addCustomer(data) {
    $.ajax({
        type: 'POST',
        url: "{{ route('customer.save') }}",
        data: data,
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            console.log(data['data']);
            location.reload();
        },
        error: function(data) {
            console.log(data);
            // message(data);
        }
    });
}

function editCustomer(data) {
    $.ajax({
        type: 'POST',
        url: "{{route('customer.update')}}",
        data: data,
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            console.log(data['data']);
            location.reload();
        },
        error: function(data) {
            alert('lỗi...');
        }
    });
}
// $('#delete').click(function() {
//     var id = $('#id_taikhoan').val()
//     var url = '/pdacc/account/delete/' + id;
//     console.log(url);
//     $('#xoa').attr('href', '');
//     $('#xoa').attr('href', url);
// })
</script>
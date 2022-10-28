
<!-- Modal -->
<div class="modal fade" id="updateInfoModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="updateInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateInfoModalLabel">Update Profile Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('profile.updateInfo')}}" method="post" id="infoUpdate">
                    @csrf
                    <div class="form-group">
                        <label>
                            <i class="mr-1 feather-phone"></i>
                            Your Phone
                        </label>
                        <input type="text" name="phone" class="form-control" value="" required>
                        @error("phone")
                        <small class="font-weight-bold text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >
                            <i class="mr-1 feather-map"></i>
                            Address
                        </label>
                        <textarea name="address" class="form-control" rows="5" required></textarea>
                        @error("address")
                        <small class="font-weight-bold text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="infoUpdate">Update</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#updateInfoModal').modal()

</script>

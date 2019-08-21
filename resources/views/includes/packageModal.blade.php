<div class="modal fade bd-newPackage-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add new Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addNewPackage">
                    @csrf
                    <div class="form-group">
                        <label>Package Name</label>
                        <input type="text" name="PackageName" id="PackageName" class="form-control inputclear" placeholder="Package name">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group">
                        <label>Package rate</label>
                        <input type="number" name="PackageRate" id="PackageRate" class="form-control inputclear" placeholder="Numbers only">
                    </div>
                    <div class="form-group">
                        <label>Additional bed rates</label>
                        <input type="number" name="additionalBedRate" id="additionalBedRate" class="form-control inputclear" placeholder="Additional bed rates">
                    </div>
                    <button type="submit" name="submit" onclick="AddPackage()" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
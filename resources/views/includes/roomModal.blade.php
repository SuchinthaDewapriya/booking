<div class="modal fade bd-newroom-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add new room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addNewRoom">
                        @csrf
                        <div class="form-group">
                            <label>Room Name</label>
                            <input type="text" name="roomName" id="roomName" class="form-control inputclear" placeholder="Room name">
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                        <div class="form-group">
                            <label>Room rate</label>
                            <input type="number" name="roomRate" id="roomRate" class="form-control inputclear" placeholder="Numbers only">
                        </div>
                        <div class="form-group">
                            <label>Room quantity</label>
                            <input type="number" name="roomQuantity" id="roomQuantity" class="form-control inputclear" placeholder="Available rooms quantity">
                        </div>
                        <div class="form-group">
                            <label>Additional bed rates</label>
                            <input type="number" name="additionalBedRate" id="additionalBedRate" class="form-control inputclear" placeholder="Additional bed rates">
                        </div>
                        <div class="form-group">
                            <label>Room description</label>
                            <textarea name="description" id="description" class="form-control inputclear" rows="5" placeholder="Room description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Room image</label>
                            <input type="file" name="roomImage" id="roomImage" class="form-control inputclear">
                        </div>
                        <button type="submit" name="submit" onclick="Addroom()" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-updateroom-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Update Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="UpdateRoomForm">
                        @csrf
                        <div class="form-group">
                            <label>Room Name</label>
                            <input type="text" name="roomName" id="UpdateroomName" class="form-control inputclear" placeholder="Room name">
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                        <div class="form-group">
                            <label>Room rate</label>
                            <input type="number" name="roomRate" id="UpdateroomRate" class="form-control inputclear" placeholder="Numbers only">
                        </div>
                        <div class="form-group">
                            <label>Room quantity</label>
                            <input type="number" name="roomQuantity" id="UpdateroomQuantity" class="form-control inputclear" placeholder="Available rooms quantity">
                        </div>
                        <div class="form-group">
                            <label>Additional bed rates</label>
                            <input type="number" name="additionalBedRate" id="UpdateadditionalBedRate" class="form-control inputclear" placeholder="Additional bed rates">
                        </div>
                        <div class="form-group">
                            <label>Room description</label>
                            <textarea name="description" id="Updatedescription" class="form-control inputclear" rows="5" placeholder="Room description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Room image</label>
                            <input type="file" name="roomImage" id="UpdateroomImage" class="form-control inputclear">
                        </div>
                            <input type="hidden" name="updateRoomId" id="updateRoomId" class="form-control inputclear">
                        <button type="submit" name="submit" onclick="Updateroom()" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
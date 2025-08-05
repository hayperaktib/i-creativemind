
<!-- Create Customer Modal -->
<div class="modal fade" id="createCustomerModal" tabindex="-1" role="dialog" aria-labelledby="createCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createCustomerModalLabel" style="font-size:12px; font-weight: bold;">New Agent Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="createForm" method="post">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="agentType" style="font-size: 12px;">Agent Type</label>
              <select name="agentType" id="agentType" class="form-control form-control-sm" style="font-size: 12px;" required>
                <option value="">select here</option>
                <option value="Full agent">Full agent</option>
                <option value="Semi SO agent">Semi SO agent</option>
                <option value="SO agent">SO agent</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="firstName" style="font-size:12px;">First Name</label>
              <input type="text" class="form-control form-control-sm" id="firstName" name="firstname" style="font-size: 12px; text-transform: capitalize;" required>
            </div>
            
            <div class="form-group col-md-4">
              <label for="middleInitial" style="font-size:12px;">Middle Initial</label>
              <input type="text" class="form-control form-control-sm" id="middleInitial" name="middle_initial" style="font-size: 12px; text-transform: capitalize;" required>
            </div>

            <div class="form-group col-md-4">
              <label for="lastName" style="font-size:12px;">Last Name</label>
              <input type="text" class="form-control form-control-sm" id="lastName" name="lastname" style="font-size: 12px; text-transform: capitalize;" required>
            </div>

          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="contactNumber" style="font-size: 12px;">ContactNumber</label>
              <input type="text" class="form-control form-control-sm" id="contactNumber" name="contact_number" style="font-size: 12px;" required>
              <small class="text-muted">Format: +639xxxxxxxxxx</small>
            </div>
            
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="cityAddress" style="font-size:12px;">Full Address</label>
              <textarea type="text" class="form-control" id="city_address" name="city_address" required style="font-size:12px;"></textarea>
            </div>
          </div>
          <button type="submit" class="btn bg-navy btn-sm" style="font-size:12px;"><i class="fas fa-check-circle"></i> Create New Record</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
<script>
$(document).ready(function() {
    // Input mask for contact number
    $('#contactNumber, #updateContactNumber').inputmask('+639999999999', {
        placeholder: '+639_________',
        clearMaskOnLostFocus: true
    });
});
</script>


<!-- Update Agent Modal -->
<div class="modal fade" id="updateCustomerModal" tabindex="-1" role="dialog" aria-labelledby="updateCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateCustomerModalLabel" style="font-size:12px;">Agent Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="updateCustomerForm" method="post">
          <input type="hidden" id="updateCustomerId" name="agent_id">
          <div class="form-row">
          <div class="form-group col-md-4">
            <label for="updateFirstName" style="font-size:12px;">First Name</label>
            <input type="text" class="form-control form-control-sm" id="updateFirstName" name="firstname" style="font-size: 12px; text-transform: capitalize;" value="<?php echo htmlspecialchars($firstname); ?>"
 required>
          </div>
          <div class="form-group col-md-4">

            <label for="updateMiddleInitial" style="font-size:12px;">Middle Name</label>
            <input type="text" class="form-control form-control-sm" id="updateMiddleInitial" name="middlename" style="font-size: 12px; text-transform: capitalize;" value="<?php echo htmlspecialchars($middlename); ?>" required>
          </div>
          <div class="form-group col-md-4">
            <label for="updateLastName" style="font-size:12px;">Last Name</label>
            <input type="text" class="form-control form-control-sm" id="updateLastName" name="lastname" style="font-size: 12px; text-transform: capitalize;" value="<?php echo htmlspecialchars($lastname); ?>" required>
          </div>
          <div class="form-group col-md-6">
            <label for="updateContactNumber" style="font-size:12px;">Contact Number</label>
            <input type="text" class="form-control form-control-sm" id="updateContactNumber" name="contact_number" style="font-size: 12px;" value="<?php echo htmlspecialchars($contact_number); ?>" required>
          </div>
          
          <div class="form-group col-md-12">
            <label for="updateCityAddress" style="font-size:12px;">Full Address</label>
            <textarea type="text" class="form-control" id="updateCityAddress" name="fulladdress" style="font-size:12px;"><?php echo htmlspecialchars($fulladdress); ?></textarea>
          </div>
          </div>
          <button type="button" class="btn xhire-info btn-sm" style="font-size:12px;" onclick="submitUpdateForm()"><i class="fas fa-pen-nib"></i> Update Record</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete Agent Modal -->
<div class="modal fade" id="deleteCustomerModal" tabindex="-1" role="dialog" aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteCustomerModalLabel" style="font-size:12px;">Delete Agent Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p style="font-size:12px;">Are you sure you want to delete this agent records?</p>
        <form id="deleteCustomerForm" action="admin_delete_agent.php" method="post">
          <input type="hidden" id="deleteCustomerId" name="deleteCustomerId">
          <button type="submit" class="btn xhire-danger btn-sm" style="font-size:12px;"><i class="fas fa-trash"></i> Delete Record</button>
          <button type="button" class="btn xhire-secondary btn-sm" style="font-size:12px;" data-dismiss="modal"><i class="fas fa-circle-xmark"></i> Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>


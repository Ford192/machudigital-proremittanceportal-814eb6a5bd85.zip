<!-- edit.blade.php -->

@extends('master')
@section('content')
<div class="container">
  <form method="post" action="{{action('CRUDController@update', $id)}}">
    
    <!-- Begin Platform Type & Date -->
    <hr class="mb-4">
              <div class="container">

              <div class="row">
                      <div class="col-md-6">
                      {{csrf_field()}}
                        <label for="country">Platform Type</label>
                          <select class="custom-select d-block w-100" id="platform" required>
                            <option value="">Choose...</option>
                            <option>Instntmny (Remittance)</option>
                            <option>Zeepay (Mobile Money)</option>
                            <option>Operational (Back Office)</option>
                          </select>
                      </div>
                      
                      <div class="col-md-6">
                        <label for="state">Date</label>
                        <input type="date" class="form-control" id="date" placeholder="" required>
                      </div>
              </div>
            </div>

              <!-- End Platform Type & Date -->



              <!-- Begin Requestor & Change N# -->
              <hr class="mb-4">
              <div class="container">

              <div class="row"> 
                      <div class="col-md-6 ">
                        <label for="RequestName">Request Name</label>
                          <input type="text" class="form-control" id="RequestorName" placeholder="Samuel Eshun" value="" required>
                      </div>
                      
                      <div class="col-md-6">
                        <label for="ChangeId">Change ID:</label>
                        <input type="text" class="form-control" id="ChangeId" placeholder="ZPCR000001" value="" required>
                      </div>
              </div>
            </div>

              <!-- End Requestor & Change N# -->
            
                
              <!-- Start Describe Change -->
              <hr class="mb-4">
              <div class="container">

              <div class="row">

                <div class="col">
                  <label for="DescribeChange"> Describe The Change Being Requested </label>
                  <textarea class="form-control" id="DescribeChangeText" rows="3"></textarea>
                </div>

              </div>
            </div>


              <!-- End Describe Change -->


              <!-- Start Describe Reason For Change -->
              <hr class="mb-4">
              <div class="container">

              <div class="row">

                <div class="col">
                  <label for="ChangeReason"> Describe The Reason For Change Being Requested </label>
                  <textarea class="form-control" id="ChangeReasonText" rows="3"></textarea>
                </div>

              </div>
            </div>


              <!-- End Describe Reason For Change -->

              
              <!-- Start Describe Technical Change -->
              <hr class="mb-4">
              <div class="container">

              <div class="row">

                <div class="col">
                  <label for="DescribeTechChange"> Describe The Technical Changes </label>
                  <textarea class="form-control" id="DescribeTechChangeText" rows="3"></textarea>
                </div>

              </div>
            </div>


              <!-- End Describe Technical Change -->


              <!-- Start Describe Risk-->
              <hr class="mb-4">
              <div class="container">

              <div class="row">

                <div class="col">
                  <label for="ChangeRisk"> Describe The Risk Associated With The Change </label>
                  <textarea class="form-control" id="ChangeRiskText" rows="3"></textarea>
                </div>

              </div>
            </div>


              <!-- End Describe Risk -->


              <!-- Start Describe Implications-->
                <hr class="mb-4">
                  <div class="container">

                      <div class="row">

                        <div class="col">
                          <label for="ChangeImplications"> Describe The Implications on Quality </label>
                          <textarea class="form-control" id="ChangeImplicationsText" rows="3"></textarea>
                        </div>

                      </div>

                  </div>


              <!-- End Describe Implications-->


              <!-- Start Disposition -->
                <hr class="mb-4">

                <div class="container">

                      <div class="row">
                              
                              <div class="col custom-control custom-radio">
                                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                                <label class="custom-control-label" for="credit">Approve</label>
                              </div>
                              
                              <div class="col custom-control custom-radio">
                                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="debit">Reject</label>
                              </div>
                              
                              <div class="col custom-control custom-radio">
                                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="paypal">Defer</label>
                              </div>
                      </div>
                </div>

              <!-- End Disposition -->

              <!-- Start Justification Implications-->
                <hr class="mb-4">
                  <div class="container">

                    <div class="row">

                      <div class="col">
                        <label for="ChangeJustification"> Describe The Justification </label>
                        <textarea class="form-control" id="ChangeJustificationText" rows="3"></textarea>
                      </div>

                    </div>
                  </div>

              <!-- End Justification Implications-->

              <!-- Start Update Button -->
              <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
              <!-- Start Update Button -->
  
  </form>
</div>
@endsection
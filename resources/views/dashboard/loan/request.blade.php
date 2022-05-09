@extends('layouts.dashboard')

@section('title')
  Loan Application
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Loan Application</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
          <div class="breadcrumb-item">Request Loan</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Request Loan</h2>
        <p class="section-lead">
          Request loan application here.
        </p>

        <div class="row">
          <div div class="col-12 col-md-12 col-lg-4">
            <div class="card card-primary">
              <form method="post" action="">
                @csrf
                <div class="card-header">
                  <h4>Loan form</h4>
                  {{--
                  <div class="card-header-action d-none d-lg-block d-xl-none">
                    <button type="button" class="btn btn-primary btn-icon icon-left" id="simulateLoan">
                      <i class="fa fa-table"></i> Simulate
                    </button>
                  </div> 
                  --}}
                </div>
                <div class="card-body">
                  <div class="row">                               
                    <div class="form-group col-md-12 col-12">
                      <label>Submission Date</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-calendar"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control datetimepicker" name="submission_date" id="submissionDate">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12 col-12">
                      <label>Total Amount</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" class="form-control" aria-label="Amount (to the nearest rupiah)" name="total_amount" id="totalAmout" value="0" min="0" step="10000">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12 col-12">
                      <label>Layaway Plan</label>
                      <select class="form-control selectric" name="layaway_plan" id="layawayPlan">
                        <option>6</option>
                        <option>10</option>
                        <option>12</option>
                        <option>18</option>
                        <option>24</option>
                        <option>36</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12 col-12">
                      <label>Infaq Amount</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" class="form-control" aria-label="Amount (to the nearest rupiah)" name="infaq_amount" id="infaqAmount" value="0" min="0">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6 col-12">
                      <label class="custom-switch mt-2">
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="isUrgent">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Urgent</span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-success m-1" type="button" id="simulateLoan">Simulate</button>
                  <button class="btn btn-primary m-1">Request</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-8">
            <div class="card card-success" id="simulationCard">
              <div class="card-header">
                <h4>Simulation</h4>
              </div>
              <div class="card-body">
                <p>Submission Date: <span class="font-weight-bold" id="simulationDate"></span></p>
                <p>Balance: <span class="font-weight-bold" id="simulationTotal">Rp. 0,00</span></p>
                <p>Total Amount: <span class="font-weight-bold" id="simulationTotal"></span></p>
                <p>Layaway Plan: <span class="font-weight-bold" id="simulationPlan"></span></p>
                <p>Interest: <span class="font-weight-bold">2%</span></p>
                <p>Infaq: <span class="font-weight-bold" id="simulationInfaq"></span></p>
                <p>Urgent: <span class="font-weight-bold" id="simulationUrgent"></span></p>
                <br>
                <p>Layaway Base per Month: <span class="font-weight-bold" id="simulationLayawayBase"></span></p>
                <p>Layaway Interest per Month: <span class="font-weight-bold" id="simulationLayawayInterest"></span></p>
                <p>Layaway Total per Month: <span class="font-weight-bold" id="simulationLayawayTotal"></span></p>
                <div id="simulationTable"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@push('scripts')
  <script src="{{ asset('assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
  <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <script>
    $(document).ready(function() {
      document.querySelector('#simulateLoan').addEventListener('click', function (e) {
        e.preventDefault();
        const submissionDateElement = document.querySelector('#submissionDate');
        const totalAmountElement = document.querySelector('#totalAmout');
        const layawayPlanElement = document.querySelector('#layawayPlan');
        const infaqAmountElement = document.querySelector('#infaqAmount');
        const isUrgentElement = document.querySelector('#isUrgent');
        // document.querySelector('#simulationCard').classList.remove('d-none');
        document.querySelector('#simulationDate').innerHTML = submissionDateElement.value;
        document.querySelector('#simulationTotal').innerHTML = `${toRupiahString(totalAmountElement.value)}`;
        document.querySelector('#simulationPlan').innerHTML = layawayPlanElement.value + ' Month';
        document.querySelector('#simulationInfaq').innerHTML = `${toRupiahString(infaqAmountElement.value)}`;
        document.querySelector('#simulationUrgent').innerHTML = isUrgentElement.checked;
        const interest = 0.02;
        const totalAmount = Number(totalAmountElement.value);
        const layawayPlan = Number(layawayPlanElement.value);
        const infaq = Number(infaqAmountElement.value);
        const layawayBase = totalAmount / layawayPlan;
        const layawayInterest = totalAmount * interest;
        const layawayTotal = layawayBase + layawayInterest + infaq;
        document.querySelector('#simulationLayawayBase').innerHTML = `${toRupiahString(layawayBase.toFixed(2))}`;
        document.querySelector('#simulationLayawayInterest').innerHTML = `${toRupiahString(layawayInterest.toFixed(2))}`;
        document.querySelector('#simulationLayawayTotal').innerHTML = `${toRupiahString(layawayTotal.toFixed(2))}`;
        const rows = Array(layawayPlan)
          .fill()
          .map((_, i) => {
            const index = i + 1;
            return `
            <tr>
              <th scope="row">${index}</th>
              <td>${toRupiahString(layawayTotal)}</td>
              <td>${toRupiahString(layawayInterest)}</td>
              <td>${toRupiahString(layawayBase)}</td>
              <td>${toRupiahString(infaq)}</td>
              <td>${toRupiahString(totalAmount-(layawayBase*index))}</td>
            </tr>
            `;
          })
          .reduce((acc, val) => acc + val, '');
        const table = `
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th scope="col">Phase</th>
                <th scope="col">Total</th>
                <th scope="col">Interest</th>
                <th scope="col">Base</th>
                <th scope="col">Infaq</th>
                <th scope="col">Balance</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">0</th>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>${toRupiahString(totalAmount)}</td>
              </tr>
              ${rows}
            </tbody>
          </table>
        </div>
        `;
        document.querySelector('#simulationTable').innerHTML = table;
      });
    });
  </script>
  @if (session()->has('Success'))
    <script>
      iziToast.info({
        title: 'Success',
        message: "{{ session('Success') }}",
        position: 'topRight'
      });
    </script>
  @elseif (session()->has('Error'))
    <script>
      iziToast.error({
        title: 'Error',
        message: "{{ session('Error') }}",
        position: 'topRight'
      });
    </script>
  @endif
@endpush

@extends('Users.Admin.Sidebar')
@section('sidebar')
@include('Components.ViewTransaction.SetProcessingModal')
@include('Components.ViewTransaction.SetRejectModal')
@include('Components.ViewTransaction.SetApproveModal')
<input type="hidden" id="transactionCode" value="{{ $transaction->code }}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">View Transaction <b>{{ $transaction->code }} - {{ $transaction->type }}</b></h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h5 class="card-title">Transaction Details</h5>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-6 d-flex justify-content-center">

                                    <button class="btn btn-primary m-2" onclick="openTransactionModal({{ $transaction->code }})">
                                        <i class="fas fa-gavel"></i> Set Processing
                                    </button>

                                    <button class="btn btn-success m-2" data-toggle="modal" data-target="#SetApproveModal">
                                        <i class="fas fa-check"></i> Set Approved
                                    </button>

                                    <button class="btn btn-danger m-2" data-toggle="modal" data-target="#SetRejectModal">
                                        <i class="fas fa-window-close"></i> Set Rejected
                                    </button>

                                </div>
                            </div>


                            @if($transaction->type == "Attestation")

                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="text-center"><b>CERTIFICATION OF ATTESTATION</b></h3>
                                    <p class="text-justify">This is to certify that Mr. /Ms. <b><span>{{ $transaction->user->completeName }}</span></b>, <b><span>{{ $transaction->attestation_details->age }}</span></b> YEARS OLD residing at <b>BARANGAY 8, MALAYBALAY CITY, BUKIDNON,</b> is currently <b><span> {{ $transaction->attestation_details->status }}</span></b> earning Php <b><span>{{ $transaction->attestation_details->income }}</span></b> per month.</p>
                                    <p class="text-justify">Following a thorough assessment and validation of the client’s socio-economic profile conducted by the Barangay Captain/Barangay Kagawad, it has been determined that Mr. /Ms <b><span>{{ $transaction->user->completeName }}</span></b>, is an individual receiving income below the regional minimum wage and is facing significant financial challenges because of the effects of inflation, like the rising prices of goods and services. The above-mentioned income remains insufficient to meet the unforeseen expenses for <b><span>{{ $transaction->attestation_details->typeOfAssistance }}</span> ASSISTANCE</b> on top of the family’s monthly household expenses amounting to Php <b><span>{{ $transaction->attestation_details->totalMonthlyHousholdExpense }}</span></b>, thus further straining their limited financial resources.</p>
                                    <p class="text-justify">This certification is issued upon the request of the above-named person for whatever legal purposes it may serve</p>
                                </div>
                                <div class="col-sm-6">
                                    <center>
                                        <img src="{{ asset('assets/images/DocImage/ATTESTATION-2026.jpg') }}" class="img-fluid">
                                    </center>

                                </div>
                            </div>

                            @elseif ($transaction->type == "Barangay Certification - Regular")
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="text-center"><b>BARANGAY CERTIFICATION - REGULAR</b></h3>
                                    <h5 class="text-justify"><b>TO WHOME IT MAY CONCERN :</b> </h5>
                                    <p class="text-justify">This is to certify that <b><span>{{ $transaction->user->completeName }}</span></b>, of legal age, Filipino, and a resident of <b><span>{{ $transaction->bar_cert_reg_details->sector }}</span></b>, <b>BARANGAY 8, MALAYBALAY CITY</b>, is a bona fide resident of this barangay. </p>
                                    <p class="text-justify">This is to certify further that she is a resident of the barangay for <b><span>{{ $transaction->bar_cert_reg_details->residentYears }}</span></b> years.</p>
                                    <p class="text-justify">This certification is issued upon the request of the above-named person for <b><span>{{ $transaction->bar_cert_reg_details->purpose }}</span></b> purposes.</p>
                                </div>
                                <div class="col-sm-6">
                                    <center>
                                        <img src="{{ asset('assets/images/DocImage/BARANGAY-CERTIFICATION-2026.jpg') }}" class="img-fluid">
                                    </center>

                                </div>
                            </div>

                            @elseif ($transaction->type == "Barangay Certification - First Time Job Seeker")
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="text-center"><b>BARANGAY CERTIFICATION - FIRST TIME JOB SEEKER</b></h3>
                                    <h5 class="text-justify"><b>TO WHOME IT MAY CONCERN :</b> </h5>
                                    <p class="text-justify">This is to certify that <b><span>{{ $transaction->user->completeName }}</span></b>, of legal age, Filipino, is a bona fide resident of <b><span>{{ $transaction->bar_cert_reg_details->sector }}</span></b> BARANGAY 8, MALAYBALAY CITY, a qualified to avail <b>RA 11261 or the FIRST TIME JOB SEEKERS ACT OF 2019.</b></p>
                                    <p class="text-justify">I further certify that the holder/bearer was informed of his/her rights, including the duties and responsibilities accorded by RA 11261 through the Oath of Undertaking he/she has signed and executed in the presence of the Barangay Official.</p>
                                    <p class="text-justify">This Barangay Certification is issued as per request of the bearer for <b><span>{{ $transaction->bar_cert_reg_details->purpose }}</span></b> purposes.</p>

                                </div>
                                <div class="col-sm-6">
                                    <center>
                                        <img src="{{ asset('assets/images/DocImage/BARANGAY-CERTIFICATION-2026-FIRST-TIME-JOB-SEEKER.jpg') }}" class="img-fluid">
                                    </center>

                                </div>
                            </div>

                            @elseif ($transaction->type == "Barangay Clearance")
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="text-center"><b>BARANGAY CLEARANCE</b></h3>
                                    <h5 class="text-justify"><b>TO WHOME IT MAY CONCERN :</b> </h5>
                                    <p class="text-justify">THIS IS TO CERTIFY that <b><span>{{ $transaction->user->completeName }}</span></b> is a bona fide resident of <b><span>{{ $transaction->bar_clear_details->sector }}</span></b> Barangay 08, Malaybalay City.</p>
                                    <p class="text-justify">He /She is known to be of <b>GOOD MORAL CHARACTER and a LAW ABIDING citizen</b>, having <b>NO DEREGATORY records</b> of complaint, civil or criminal, filed against him/her and pending in the Barangay 08 office</p>
                                    <p class="text-justify">This Barangay Certification is issued as per request of the bearer for <b><span>{{ $transaction->bar_clear_details->purpose }}</span></b>.</p>
                                </div>
                                <div class="col-sm-6">
                                    <center>
                                        <img src="{{ asset('assets/images/DocImage/BARANGAY-CLEARANCE-2026.jpg') }}" class="img-fluid">
                                    </center>
                                </div>
                            </div>

                            @elseif ($transaction->type == "Barangay Identification")
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="text-center"><b>BARANGAY IDENTIFICATION</b></h3>
                                    <p class="text-start"><b>TO WHOM IT MAY CONCERN: </b></p>
                                    <p class="text-justify">THIS IS TO CERTIFY that <b><span>{{ $transaction->user->completeName }}</span></b> is a bona fide resident at <b><span>{{ $transaction->bar_iden_details->sector }}</span></b> Barangay 08, Malaybalay City.</p>
                                    <p class="text-justify"><b>THIS IS TO CERTIFY FURTHER</b> that she/he is found to be indigent after the assessment made by the office regarding their annual income.</p>
                                    <p class="text-justify">This certification is issued upon the request of the above-named person for <b>IDENTIFICATION purposes.</b></p>
                                </div>
                                <div class="col-sm-6">
                                    <center>
                                        <img src="{{ asset('assets/images/DocImage/BARANGAY-IDENTIFICATION-2026.jpg') }}" class="img-fluid">
                                    </center>

                                </div>
                            </div>
                            @elseif ($transaction->type == "Barangay Indigency - Regular")
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="text-center"><b>BARANGAY INDIGENCY - REGULAR</b></h3>
                                    <h5 class="text-justify"><b>TO WHOME IT MAY CONCERN :</b> </h5>
                                    <p class="text-justify">This is to certify that <b><span>{{ $transaction->user->completeName }}</span></b>, a bona fide resident of <b><span>{{ $transaction->bar_indigent_details->sector }}</span></b> Barangay 8, Malaybalay City. </p>
                                    <p class="text-justify">That the subject is <b>categorized as an indigent</b> member of the community and having a monthly income that is insufficient to meet the basic needs of their family.</p>
                                    <p class="text-justify">This certification is issued upon the request of <b><span>{{ $transaction->user->completeName }}</span></b>.</p>
                                    <p class="text-justify">THIS DOCUMENT SHALL SERVE AS A SUPPORTING REQUIREMENT FOR <b><span>{{ $transaction->bar_indigent_details->purpose }}</span> purposes</b> .</p>
                                </div>
                                <div class="col-sm-6">
                                    <center>
                                        <img src="{{ asset('assets/images/DocImage/BARANGAY-INDIGENCY-2026-NEW-Copy.jpg') }}" class="img-fluid">
                                    </center>

                                </div>
                            </div>
                            @elseif ($transaction->type == "Barangay Indigency - Patient Name")
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="text-center"><b>BARANGAY INDIGENCY - PATIENT NAME</b></h3>
                                    <h5 class="text-justify"><b>TO WHOME IT MAY CONCERN :</b> </h5>
                                    <p class="text-justify">This is to certify that <b><span>{{ $transaction->user->completeName }}</span></b>, a bona fide resident of <b><span>{{ $transaction->bar_indigent_details->sector }}</span></b> Barangay 8, Malaybalay City. </b></p>
                                    <p class="text-justify">That the subject is categorized as an indigent member of the community and she/he is the <b><span>{{ $transaction->bar_indigent_details->relation }}</span></b> of <b><span>{{ $transaction->bar_indigent_details->authorized }}</span></b> (patient) having a monthly income that is insufficient to meet the basic needs of their family.</p>
                                    <p class="text-justify">This certification is issued upon the request of <b><span>{{ $transaction->user->completeName }}</span></b>.</p>
                                    <p class="text-justify">THIS DOCUMENT SHALL SERVE AS A SUPPORTING REQUIREMENT FOR <b><span>{{ $transaction->bar_indigent_details->purpose }}</span></b> purposes.</p>
                                </div>
                                <div class="col-sm-6">
                                    <center>
                                        <img src="{{ asset('assets/images/DocImage/BARANGAY-INDIGENCY-2026-WITH-PATIENT-NAME.jpg') }}" class="img-fluid">
                                    </center>

                                </div>
                            </div>
                            @else

                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script src="{{ asset("assets/Javascripts/ViewTransactions/Admin/viewTransactions.js") }}"></script>
<!-- /.content-wrapper -->
@endsection

@if($transaction->type == "Barangay Clearance")
@include("Printable.BarangayClearance")
@elseif ($transaction->type == "Barangay Certification")
@include("Printable.BarangayCertification")
@else
@include("Printable.CertificateOfIndigency")
@endif

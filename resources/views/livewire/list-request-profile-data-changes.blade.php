 <div class="container">
     <div class="section-title">
         <h2>Permintaan Perubahan Data Profile</h2>
         <p>Permintaan Perubahan Profile Data Siswa Kelas
             {{$grade}}</p>
     </div>

     @include("livewire.partials.alert")

     @if($list_profile_request->count() > 3)
         <div class="owl-carousel testimonials-carousel" style="margin-top:-50px;">
             @each("livewire.request_profile_data_changes.profile_request", $list_profile_request, "profile_request")
         </div>
     @elseif($list_profile_request->count() >= 1)
         <div class="d-lg-flex justify-content-center" style="margin-top:-50px;">
             @each("livewire.request_profile_data_changes.profile_request", $list_profile_request, "profile_request")
         </div>
     @else
         <div class="d-lg-flex justify-content-center">
             <div class="card p-3" style="border-radius: 10px; min-height: 0;">
                 <div class="d-flex justify-content-between">
                     <div class="d-flex flex-row align-items-center">
                         <div class="ms-2 c-details">
                             <h6 class="mb-0">Wali Kelas: <b>{{$grade}}</b></h6>
                         </div>
                     </div>
                     <div class="badge">
                        <span>{{auth()->user()->gender === "Laki-Laki" ? "Bapak" : "Ibu" . " " . auth()->user()->name}}</span>
                     </div>
                 </div>
                 <div class="mt-5">
                     <h5 class="heading">Tidak Ada Siswa Yang <br>Mengajukan Perubahan Data</h5>
                 </div>
                 <hr>
             </div>
         </div>
     @endif

     <br><br><br>
 </div>

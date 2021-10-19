 <div class="container">
     <div class="section-title">
         <h2>Permintaan Perubahan Data Profile</h2>
         <p>Permintaan Perubahan Data Profil Siswa Kelas
             {{$grade}}</p>
     </div>

     @include("livewire.partials.alert")

     {{$list_profile_request?->links("livewire.partials.pagination")}}

     <div style="margin-top:-50px;" @class([
         "owl-carousel testimonials-carousel" => $this->getDataRequest()?->count() > 3,
         "d-lg-flex justify-content-center" => $this->getDataRequest()?->count() >= 1
     ])>
        @each("livewire.request_profile_data_changes.profile_request", $list_profile_request ?? [], "profile_request", "livewire.request_profile_data_changes.empty")
     </div>

     <br><br><br>
 </div>

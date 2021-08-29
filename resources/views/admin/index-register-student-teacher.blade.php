@extends("template.app")

@section("content")

    <section class="features" id="list_link_teacher_student">
        <div class="container">
            <div class="section-title" data-aos="zoom-out">
                <h2>Link Pendaftaran Guru Wali Kelas & Peserta Didik</h2>
                {{-- <p>Yang di petakan dalam bentuk tabel</p> --}}
                <div class="mt-3">
                    <button class="btn btn-outline-info mr-3 active">Peserta Didik</button>
                    <button class="btn btn-outline-primary">Guru Wali Kelas</button>
                </div>
            </div>
{{--            <input name="search_student" type="text" class="form-control col-lg-6 mb-3" placeholder="">--}}
            <a href="#" class="btn-sm btn-success mb-2 float-lg-right" data-aos="zoom-out">Tambahkan Link</a>
            <table class="table table-hover" data-aos="zoom-out">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>

@endsection

@section("hero")
    @include("admin.partials.hero")
@endsection

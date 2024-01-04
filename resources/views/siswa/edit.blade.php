<form action="/siswa/{{$siswa -> nisn }}/update" method="POST" id="frmsiswa" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                                <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-numbers" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 6h9" /><path d="M11 12h9" /><path d="M12 18h8" /><path d="M4 16a2 2 0 1 1 4 0c0 .591 -.5 1 -1 1.5l-3 2.5h4" /><path d="M6 10v-6l-2 2" /></svg>
                                </span>
                                <input type="text" value="{{$siswa -> nisn }}" name="nisn" id="nisn" class="form-control text-danger" placeholder="NISN" readonly>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-12">
                                        <select class="form-select" name="kode_kelas" id="kode_kelas" >
                                        <option selected="" >Pilih Kelas</option>
                                                    @foreach ($kelas as $d)
                                                    <option {{ $siswa -> kode_kelas == $d -> kode_kelas ? 'selected':''}} value="{{$d -> kode_kelas }}"> {{ $d -> nama_kelas }} </option>
                                                    @endforeach
                                      </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <select class="form-select" name="kode_kegiatan" id="kode_kegiatan" >
                                        <option value="00" >Pilih Kegiatan (opsional)</option>
                                                    @foreach ($kegiatan as $d)
                                                    <option {{ $siswa -> kode_kegiatan == $d -> kode_kegiatan ? 'selected':''}} value="{{$d -> kode_kegiatan }}"> {{ $d -> nama_kegiatan }} </option>
                                                    @endforeach
                                      </select>
                                    </div>
                                </div>

                                <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-scan" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 9a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M4 8v-2a2 2 0 0 1 2 -2h2" /><path d="M4 16v2a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v2" /><path d="M16 20h2a2 2 0 0 0 2 -2v-2" /><path d="M8 16a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2" /></svg>
                                </span>
                                <input
                                    type="text" value="{{$siswa -> jabatan }}" name="jabatan" id="jabatan" class="form-control text-danger" placeholder="jabatan" readonly>
                                </div>



                                <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                                </span>
                                <input type="text" value="{{$siswa -> nama_lengkap }}" id="nama_lengkap" class="form-control" name="nama_lengkap" placeholder="NAMA LENGKAP">
                                </div>


                                <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /><path d="M15 6h6m-3 -3v6" /></svg>
                                </span>
                                <input type="number" value="{{$siswa -> no_hp}}" name="no_hp" id="no_hp" class="form-control" placeholder="Nomor Hp">
                                </div>
                                <!-- ============ -->
                                <div class="mb-3">
                            <div class="form-label">Tambahkan Foto</div>
                            <input type="file" class="form-control" name="foto" id="foto">
                            <input type="hidden" name="old_foto" value="{{ $siswa -> foto}}">
                          </div>


                    </div>
                </div>
            <div class="row">
                <div class="col modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary">Simpan Perubahan</button>

            </div>
            </div>
            </form>

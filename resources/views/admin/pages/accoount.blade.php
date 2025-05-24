@extends('admin.layouts.app')

@section('content')
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="card shadow rounded-4 p-4">
          @if (session()->has('createsuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('createsuccess') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          <h4 class="mb-4">Create Account</h4>
          <form action="/CreateAccount" method="POST" class="row g-3" enctype="multipart/form-data" id="accountForm">
            @csrf
            <div class="col-md-6">
              <label for="InputUsername" class="form-label">Username</label>
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="InputUsername" name="username" value="{{ old('username') }}">
              @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="InputEmail" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="InputEmail" name="email" value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-6">
              <label for="inputAddress" class="form-label">Address</label>
              <input type="text" class="form-control @error('address') is-invalid @enderror" id="inputAddress" name="address" value="{{ old('address') }}">
              @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="inputPhone" class="form-label">Phone</label>
              <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="inputPhone" name="phone" value="{{ old('phone') }}">
              @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 position-relative">
              <label for="inputPassword4" class="form-label">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword4" name="password">
              <i class="bi bi-eye-slash position-absolute text-secondary" id="togglePassword" style="top: 74%; right: 22px; transform: translateY(-50%); cursor: pointer;"></i>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="inputState" class="form-label">User Role</label>
              <select id="inputState" class="form-select @error('role') is-invalid @enderror" name="role">
                <option value="" selected>Choose Role...</option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="worker" {{ old('role') === 'worker' ? 'selected' : '' }}>Worker</option>
              </select>
              @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 position-relative">
              <label for="confirmPassword" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="confirmPassword" name="password_confirmation">
              <i class="bi bi-eye-slash position-absolute text-secondary" id="toggleConfirmPassword" style="top: 74%; right: 22px; transform: translateY(-50%); cursor: pointer;"></i>
              @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Hidden inputs untuk menyimpan skills yang dipilih -->
            <div id="selectedSkillsContainer">
              @if(old('skills'))
                @foreach(old('skills') as $skill)
                  <input type="hidden" name="skills[]" value="{{ $skill }}">
                @endforeach
              @endif
            </div>

            <div class="input-group mb-3">
              <input type="file" class="form-control @error('photo') is-invalid @enderror" id="inputGroupFile02" name="photo">
              <label class="input-group-text" for="inputGroupFile02">Upload</label>
              @error('photo')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-12">
              <button type="submit" class="btn btn-primary">Create Account</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal untuk Skill Worker -->
  <div class="modal fade" id="workerModal" tabindex="-1" aria-labelledby="workerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content rounded-4">
        <div class="modal-header">
          <h5 class="modal-title" id="workerModalLabel">Pilih Skill Worker</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Silakan pilih skill yang dimiliki worker:</p>
          
          <div class="row skills-container">
            @foreach ($services as $service)
              <div class="col-md-4 mb-2">
                <div class="form-check">
                  <input class="form-check-input worker-skill" type="checkbox" 
                         value="{{ $service->id }}" 
                         id="skill{{ $service->id }}" 
                         {{ (collect(old('skills'))->contains($service->id)) ? 'checked' : '' }}>
                  <label class="form-check-label" for="skill{{ $service->id }}">
                    {{ $service->name }}
                  </label>
                </div>
              </div>
            @endforeach
          </div>

          <div class="mt-4">
            <h6>Skill yang dipilih:</h6>
            <div id="selectedSkillsList" class="d-flex flex-wrap gap-2 mt-2">
              <!-- Skills badges will appear here -->
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" id="saveSkills">Simpan Skill</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Pastikan Bootstrap telah dimuat
      if (typeof bootstrap === 'undefined') {
        console.error('Bootstrap JS tidak dimuat!');
        return;
      }
      
      // Modal element
      const modalElement = document.getElementById('workerModal');
      
      if (!modalElement) {
        console.error('Modal element tidak ditemukan!');
        return;
      }
      
      // Inisialisasi modal dengan Bootstrap
      const workerModal = new bootstrap.Modal(modalElement);
      
      // Event listener untuk select role
      const roleSelect = document.getElementById('inputState');
      if (roleSelect) {
        roleSelect.addEventListener('change', function() {
          if (this.value === 'worker') {
            workerModal.show();
          }
        });
        
        // Jika role worker sudah dipilih sebelumnya (misalnya pada validasi form)
        if (roleSelect.value === 'worker') {
          // Tunggu sedikit sebelum membuka modal untuk menghindari konflik
          setTimeout(() => {
            workerModal.show();
          }, 500);
        }
      }
      
      // Fungsi untuk memperbarui badge skill yang dipilih
      function updateSelectedSkillsDisplay() {
        const selectedSkills = [];
        const skillCheckboxes = document.querySelectorAll('.worker-skill:checked');
        const selectedSkillsList = document.getElementById('selectedSkillsList');
        const selectedSkillsContainer = document.getElementById('selectedSkillsContainer');
        
        // Hapus semua input hidden skills sebelumnya
        selectedSkillsContainer.innerHTML = '';
        
        if (skillCheckboxes.length === 0) {
          selectedSkillsList.innerHTML = '<span class="text-muted">Belum ada skill yang dipilih</span>';
        } else {
          selectedSkillsList.innerHTML = '';
          
          skillCheckboxes.forEach(checkbox => {
            // Ambil nama skill dari label
            const skillName = checkbox.nextElementSibling.textContent.trim();
            const skillId = checkbox.value;
            
            // Buat badge untuk ditampilkan
            const badge = document.createElement('span');
            badge.className = 'badge bg-primary me-1 mb-1';
            badge.textContent = skillName;
            selectedSkillsList.appendChild(badge);
            
            // Tambahkan input hidden untuk form submission
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'skills[]';
            hiddenInput.value = skillId;
            selectedSkillsContainer.appendChild(hiddenInput);
          });
        }
      }
      
      // Event listeners untuk checkbox skill
      const skillCheckboxes = document.querySelectorAll('.worker-skill');
      skillCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedSkillsDisplay);
      });
      
      // Tampilkan skill yang sudah dipilih saat halaman dimuat (untuk kasus validasi form)
      updateSelectedSkillsDisplay();
      
      // Event listener untuk tombol simpan skill
      const saveSkillsButton = document.getElementById('saveSkills');
      if (saveSkillsButton) {
        saveSkillsButton.addEventListener('click', function() {
          // Pastikan skills update terakhir tersimpan
          updateSelectedSkillsDisplay();
          // Tutup modal
          workerModal.hide();
        });
      }
      
      // Event listener untuk tombol close modal
      const closeButtons = document.querySelectorAll('[data-bs-dismiss="modal"]');
      closeButtons.forEach(button => {
        button.addEventListener('click', function() {
          workerModal.hide();
        });
      });
    });
  </script>
@endsection
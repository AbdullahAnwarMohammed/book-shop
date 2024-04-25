<div>
    <form  method="POST" autocomplete="off" wire:submit.prevent="LoginHandler()" >
        <div class="mb-3">
          <label class="form-label">البريد</label>
          <input type="email" class="form-control" placeholder="البريد الخاص بك" wire:model="email" autocomplete="off">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-2">
          <label class="form-label">
            كلمة السر
          </label>
            <input type="password" class="form-control" wire:model="password"  placeholder="كلمة المرور"  autocomplete="off">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
      
        <div class="form-footer">
          <button type="submit" class="btn btn-primary w-100">تسجيل الدخول</button>
        </div>
      </form>
</div>

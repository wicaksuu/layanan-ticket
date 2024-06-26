                                                    <div class="card">
                                                        <div class="card-header border-0">
                                                            <h4 class="card-title">{{lang('Change Password')}}</h4>
                                                        </div>
                                                        <form method="POST" action="{{ route('change.password') }}">
                                                            @csrf

                                                            @honeypot

                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @if (Auth::user()->password != null)
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <label class="form-label mb-0 mt-2">{{lang('Old Password')}}<span class="text-red">*</span></label>
                                                                            </div>
                                                                            <div class="col-md-9">
                                                                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" placeholder="{{lang('password')}}" value="" name="current_password" autocomplete="current_password">
                                                                                @error('current_password')

                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ lang($message) }}</strong>
                                                                                    </span>
                                                                                @enderror

                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label class="form-label mb-0 mt-2">{{lang('New Password')}}<span class="text-red">*</span></label>
                                                                        </div>
                                                                        <div class="col-md-9 password-change">
                                                                            <div class="input-group d-md-flex d-block">
                                                                                <input type="password" class="form-control sprukopsdauto @error('password') is-invalid @enderror" placeholder="{{lang('password')}}" value=""name="password" autocomplete="password">

                                                                                <div class="input-group-text p-0 ">
                                                                                     <button type="button"  class="btn btn-light-2  sprukovisipsd"><i class="fe fe-eye"></i></button>
                                                                                     <button type="button" class="btn btn-light-2   br-br-5 br-tr-5 sprukogenratepsd" >{{lang('Generate Password')}}</button>
                                                                                </div>
                                                                                @error('password')

                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ lang($message) }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label class="form-label mb-0 mt-2">{{lang('Confirm Password')}}<span class="text-red">*</span></label>
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{lang('Confirm Password')}}" value=""name="password_confirmation" autocomplete="password_confirmation">
                                                                            @error('password_confirmation')

                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ lang($message) }}</strong>
                                                                                </span>
                                                                            @enderror

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer text-end">
                                                            <button type="submit" class="btn btn-secondary" onclick="this.disabled=true;this.form.submit();">{{lang('Save Changes')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <script>
                                                        "use strict";
                                                        let sprukogenpsd = document.querySelector('.sprukogenratepsd');
                                                        let sprukopsdauto = document.querySelector('.sprukopsdauto');
                                                        let sprukovisipsd = document.querySelector('.sprukovisipsd i');
                                                        let sprukovisipsds = document.querySelector('.sprukovisipsd');

                                                        sprukogenpsd.addEventListener('click', () => {
                                                            var password = '';
                                                            var strs = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' +
                                                                    'abcdefghijklmnopqrstuvwxyz0123456789@#$';

                                                            for (let i = 1; i <= 10; i++) {
                                                                var char = Math.floor(Math.random()
                                                                            * strs.length + 1);

                                                                password += strs.charAt(char)
                                                            }
                                                            sprukopsdauto.value = password;
                                                        });

                                                        sprukovisipsds.addEventListener('click', ()=>{

                                                            if(sprukopsdauto.getAttribute('type') == "text"){

                                                                sprukopsdauto.setAttribute('type', 'password');
                                                                sprukovisipsd.removeAttribute('class', 'fe fe-eye-off');
                                                                sprukovisipsd.setAttribute('class', 'fe fe-eye');
                                                            }else if(sprukopsdauto.getAttribute('type') == "password"){
                                                                sprukopsdauto.setAttribute('type', 'text');
                                                                sprukovisipsd.removeAttribute('class', 'fe fe-eye');
                                                                sprukovisipsd.setAttribute('class', 'fe fe-eye-off');
                                                            }
                                                        });



                                                    </script>

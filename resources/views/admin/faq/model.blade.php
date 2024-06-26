  		<!-- Add FAQ-->
          <div class="modal fade sprukofaqcat"  id="addfaq" aria-hidden="true">
			<div class="modal-dialog  modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"></h5>
						<button  class="close" data-bs-dismiss="modal" onclick="cancelPost()" aria-label="Close">
							<span aria-hidden="true" onclick="cancelPost()">×</span>
						</button>
					</div>
					<form method="POST" id="faq_form">
                        <input type="hidden" name="faq_id" id="faq_id">
                        @csrf
                        @honeypot
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label">{{lang('Question')}} <span class="text-red">*</span></label>
                                <input type="text" class="form-control" placeholder="{{lang('FAQ Question')}}" name="question" id="question"  autofocus required>
                                <span id="questionError" class="text-danger alert-message"></span>
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{lang('Answer')}} <span class="text-red">*</span></label>
                                <textarea class="summernote d-none " placeholder="{{lang('FAQ Answer')}}" name="answer" id="answer" aria-multiline="true"></textarea>

                                <span id="answerError" class="text-danger alert-message"></span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{lang('Select Faq Category')}} <span class="text-red">*</span></label>
                                <select name="faqcat_name" class="form-control" id="faqcat_name" data-placeholder="{{lang('Select Faq Category')}}"></select>
                                <span id="faqcategoryError" class="text-danger alert-message"></span>
                            </div>
                            <div class="form-group">
                                <div class="switch_section">
                                    <div class="switch-toggle d-flex mt-4">
                                        <label class="form-label pe-2">{{lang('Status')}}</label>
                                        <a class="onoffswitch2">
                                            <input type="checkbox"  name="status" id="status" class=" toggle-class onoffswitch2-checkbox" >
                                            <label for="status" class="toggle-class onoffswitch2-label" ></label>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="custom-control form-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="privatemode" id="privatemode">
                                    <span class="custom-control-label">{{lang('Privacy Mode')}}</span>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-outline-danger" id="btnclose" onclick="cancelPost()" data-bs-dismiss="modal">{{lang('Close')}}</a>
                            <button type="button" class="btn btn-secondary" id="btnsave" onclick="createPost()" >{{lang('Save')}}</button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
		<!-- End  Add FAQ  -->

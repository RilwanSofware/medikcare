<div id="addIpdPaymentModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.ipd_payments.add_ipd_payment') }}</h2>
                <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-primary"
                        data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
							<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                               fill="#000000">
								<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"/>
								<rect fill="#000000" opacity="0.5"
                                      transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                      x="0" y="7" width="16" height="2" rx="1"/>
							</g>
						</svg>
					</span>
                </button>
            </div>
            {{ Form::open(['id'=>'addIpdPaymentNewForm']) }}
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                @if($ipdPatientDepartment->bill)
                    <div class="alert alert-warning">
                        <span>Note: After adding Payment you must need to re-generate Bill.</span>
                    </div>
                @endif
                <div class="alert alert-danger display-none hide" id="paymentValidationErrorsBox"></div>
                {{ Form::hidden('ipd_patient_department_id',$ipdPatientDepartment->id) }}
                <div class="row">
                    <div class="form-group col-md-6 mb-5">
                        <div class="form-group">
                            {{ Form::label('amount', __('messages.ambulance_call.amount').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                            <div class="input-group">
                                {{ Form::text('amount', null, ['class' => 'form-control form-control-solid price-input','id' => 'ipdPaymentAmount', 'required']) }}
                                <div class="input-group-text border-0"><a><i class="{{ getCurrenciesClass() }}"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-5">
                        <div class="form-group">
                            {{ Form::label('date', __('messages.ipd_patient_charges.date').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                            {{ Form::text('date', null, ['class' => 'form-control form-control-solid','id' => 'ipdPaymentDate','autocomplete' => 'off', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('charge_type_id', __('messages.ipd_payments.payment_mode').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('payment_mode', $paymentModes, null, ['class' => 'form-select form-select-solid select2Selector', 'id' => 'paymentModeId', 'required','placeholder'=>'Select Payment Mode']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        <div class="row2">
                            {{ Form::label('document', __('messages.ipd_patient_diagnosis.document').':',['class' => 'fs-5 fw-bolder text-gray-600 mb-2 d-block']) }}
                            <div class="image-input image-input-outline" data-kt-image-input="true">
                                <div class="image-input-wrapper w-125px h-125px bgi-position-center"
                                     id="paymentPreviewImage"
                                     style="background-image: url({{ asset('assets/img/default_image.jpg') }})"></div>

                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                    data-kt-image-input-action="change"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Change document">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="file" name="file" id="paymentDocumentImage"
                                           class="d-none document-file"/>
                                    <input type="hidden" name="avatar_remove"/>
                                </label>

                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                    data-kt-image-input-action="cancel"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Cancel document">
                        <i class="bi bi-x fs-2"></i>
                </span>
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow remove-image"
                                    data-kt-image-input-action="remove"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Remove document">
                        <i class="bi bi-x fs-2"></i>
                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group mb-5">
                            {{ Form::label('notes', __('messages.ipd_patient.notes').':',['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                            {{ Form::textarea('notes', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
                        </div>
                    </div>

                </div>
                <div class="d-flex mt-5">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnIpdPaymentSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light btn-active-light-primary me-2"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

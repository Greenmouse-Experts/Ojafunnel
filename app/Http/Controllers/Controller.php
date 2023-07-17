<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function __invoke(User $user)
    // {
    //     return $user;
    // }

    public function noMoreItem()
    {
        return view('noMoreItem');
    }

    public function datatable_locale()
    {
        echo '{
            "sEmptyTable":     "' . trans('messages.datatable_sEmptyTable') . '",
            "sProcessing":   "' . trans('messages.datatable_sProcessing') . '",
            "sLengthMenu":   "' . trans('messages.datatable_sLengthMenu') . '",
            "sZeroRecords":  "' . trans('messages.datatable_sZeroRecords') . '",
            "sInfo":         "' . trans('messages.datatable_sInfo') . '",
            "sInfoEmpty":    "' . trans('messages.datatable_sInfoEmpty') . '",
            "sInfoFiltered": "' . trans('messages.datatable_sInfoFiltered') . '",
            "sInfoPostFix":  "' . trans('messages.datatable_sInfoPostFix') . '",
            "sSearch":       "' . trans('messages.datatable_sSearch') . '",
            "sUrl":          "' . trans('messages.datatable_sUrl') . '",
            "oPaginate": {
                "sFirst":    "' . trans('messages.datatable_sFirst') . '",
                "sPrevious": "' . trans('messages.datatable_sPrevious') . '",
                "sNext":     "' . trans('messages.datatable_sNext') . '",
                "sLast":     "' . trans('messages.datatable_sLast') . '"
            },
            "oAria": {
                "sSortAscending":  "' . trans('messages.datatable_sSortAscending') . '",
                "sSortDescending": "' . trans('messages.datatable_sSortDescending') . '"
            }
        }';
    }

    /**
     * Translate jqery validate.
     *
     * @return text
     */
    public function jquery_validate_locale()
    {
        return response('jQuery.extend(jQuery.validator.messages, {
            required: "' . trans('messages.jvalidate_required') . '",
            remote: "' . trans('messages.jvalidate_remote') . '",
            email: "' . trans('messages.jvalidate_email') . '",
            url: "' . trans('messages.jvalidate_url') . '",
            date: "' . trans('messages.jvalidate_date') . '",
            dateISO: "' . trans('messages.jvalidate_dateISO') . '",
            number: "' . trans('messages.jvalidate_number') . '",
            digits: "' . trans('messages.jvalidate_digits') . '",
            creditcard: "' . trans('messages.jvalidate_creditcard') . '",
            equalTo: "' . trans('messages.jvalidate_equalTo') . '",
            accept: "' . trans('messages.jvalidate_accept') . '",
            maxlength: jQuery.validator.format("' . trans('messages.jvalidate_maxlength') . '"),
            minlength: jQuery.validator.format("' . trans('messages.jvalidate_minlength') . '"),
            rangelength: jQuery.validator.format("' . trans('messages.jvalidate_rangelength') . '"),
            range: jQuery.validator.format("' . trans('messages.jvalidate_range') . '"),
            max: jQuery.validator.format("' . trans('messages.jvalidate_max') . '"),
            min: jQuery.validator.format("' . trans('messages.jvalidate_min') . '")
        });')->header('Content-Type', 'application/javascript');
    }
}

<style>
    table,
    tr,
    td {
        padding: 5px 5px;
    }
</style>
@foreach ($users as $user)
    <table border="1" class="nk-tb-list nk-tb-ulist">
        <thead>
            <tr class="">
                <td colspan="3">
                    <span class="">{{ date('F Y ', strtotime($date)) }}</span>
                </td>
                <td colspan="9">
                    <span class="">{{ $user->name }}</span>
                </td>
            </tr>
            <tr class="nk-tb-item nk-tb-head">
                <th colspan="2" class="nk-tb-col tb-col-mb"><span class="sub-text">S.no</span>
                </th>
                <th colspan="2" class="nk-tb-col"><span class="sub-text">Date</span>
                </th>
                <th colspan="2" class="nk-tb-col"><span class="sub-text">Check
                        in Time</span>
                </th>
                <th colspan="2" class="nk-tb-col"><span class="sub-text">Check
                        out Time</span>
                </th>
                <th colspan="2" class="nk-tb-col"><span class="sub-text">Total
                        Hours</span>
                </th>
                <th colspan="2" class="nk-tb-col"><span class="sub-text">Remarks</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $user_daily_time = App\Models\Attendance::where('user_id', $user->id)
                ->whereMonth('date', $date->month)
                ->whereYear('date', $date->year)
                ->get();
            $j = 1;
            ?>
            @foreach ($user_daily_time as $attend)
                <tr class="nk-tb-item user_row">
                    <td colspan="2"><span>{{ $j++ }} </span></td>
                    <td colspan="2" class="nk-tb-col tb-col-md">
                        <span style="color: black">{{ $attend->date }}</span>
                    </td>
                    <td colspan="2" class="nk-tb-col tb-col-md">
                        <span style="color: black">{{ $attend->check_in_time }}</span>
                    </td>
                    <td colspan="2" class="nk-tb-col tb-col-md">
                        <span style="color: black">{{ $attend->check_out_time }}</span>
                    </td>
                    <td colspan="2" class="nk-tb-col tb-col-md">
                        <span style="color: black">{{ $attend->total_logged_hours }}</span>
                    </td>
                    <td colspan="2" class="nk-tb-col tb-col-md">
                        @if ($attend->total_hours_inSec != 0 && $attend->total_hours_inSec != null)
                            <?php
                            $sec = 28800 - $attend->total_hours_inSec;
                            $extra_sec = explode('-', $sec);
                            ?>
                            @if ($sec > 0)
                                <span style="color: black">
                                    -{{ seconds_to_hours_minutes(last($extra_sec)) }}
                                </span>
                            @elseif($sec < 0)
                                <span style="color: black">
                                    +{{ seconds_to_hours_minutes(last($extra_sec)) }}
                                </span>
                            @else
                                {{ 0.0 }}
                            @endif
                        @else
                            <span style="color: black">Checkin/checkout Missing</span>
                        @endif
                    </td>
                </tr><!-- .nk-tb-item  -->
            @endforeach
        </tbody>
        <tr>
            <?php
            $total_sec_month = $monthly_working_hours * 3600;
            $remaining_sec = $total_sec_month - $user->seconds;
            $extra_hours = explode('-', $remaining_sec);
            $percent = ($user->seconds / $total_sec_month) * 100;
            
            ?>
            <td colspan="8" style="text-align: right">Hours Worked</td>
            <td colspan="4">{{ seconds_to_hours_minutes($user->seconds) }}</td>
        </tr>
        <tr>
            @if ($remaining_sec < 0)
                <td colspan="8" style="text-align: right">Extra</td>
                <td colspan="4">+{{ seconds_to_hours_minutes(last($extra_hours)) }}</td>
            @elseif($remaining_sec > 0)
                <td colspan="8" style="text-align: right">Missing</td>
                <td colspan="4">-{{ seconds_to_hours_minutes(last($extra_hours)) }}</td>
            @else
                <td colspan="8" style="text-align: right">Extra / Missing</td>
                <td colspan="4">0.0</td>
            @endif
        </tr>
        <tr>
            <td colspan="8" style="text-align: right">Expected Working Hours</td>
            <td colspan="4">{{ $monthly_working_hours }}</td>
        </tr>
        <tr>
            <td colspan="8" style="text-align: right">Percentage</td>
            <td colspan="4">{{ round($percent, 2) }}%</td>
        </tr>
        <tr>
            <td colspan="12"></td>
        </tr>
    </table>
@endforeach

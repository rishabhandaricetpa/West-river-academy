  <table class="my-4 table-bordered table-striped w-50">
      <thead>
          <tr>
              <th class="p-1">Variables - Wrap in {{}}</th>
              <th class="p-1"> Meaning</th>
          </tr>
      </thead>
      <tbody>
          <tr>

              @if ($type == 'enrollment')
          <tr>
              <td class="p-1"> $student_name </td>
              <td class="p-1"> Student Name</td>
          </tr>
          <tr>
              <td class="p-1"> $enrollment_start_date </td>
              <td class="p-1"> Enrollment Start Date</td>
          </tr>
          <tr>
              <td class="p-1"> $enrollment_end_date </td>
              <td class="p-1"> Enrollment End Date</td>
          </tr>
      @elseif($type=='record_transfer')
          <td class="p-1"> answer 122 </td>
          <td class="p-1"> answer 211</td>
      @elseif($type=='graduation')
          <tr>
              <td class="p-1">$data->total_fee</td>
              <td class="p-1"> Total Fees</td>
          </tr>
          <tr>
              <td class="p-1">$data->message</td>
              <td class="p-1"> Final transcript (Optional) </td>
          </tr>
          @endif
          </tr>
      </tbody>
  </table>

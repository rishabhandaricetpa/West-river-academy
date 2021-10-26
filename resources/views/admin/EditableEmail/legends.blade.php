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
      @elseif($type=='moneygram')
          <tr>
              <td class="p-1"> $user_name</td>
              <td class="p-1"> User Name</td>
          </tr>
          <tr>
              <td class="p-1"> $amount</td>
              <td class="p-1"> Amount</td>
          </tr>
      @elseif($type=='graduation')
          <tr>
              <td class="p-1">$total_fees</td>
              <td class="p-1"> Total Fees</td>
          </tr>
      @elseif($type=='moneyorder')
          <tr>
              <td class="p-1">$user_name</td>
              <td class="p-1"> User Name</td>
          </tr>
          @endif
          </tr>
      </tbody>
  </table>

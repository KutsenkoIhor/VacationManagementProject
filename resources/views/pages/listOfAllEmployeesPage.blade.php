@extends('templates.mainPageTemplate')

@section('content')
    <pre>
        USER:
            System Administrator
        TASK:
            System Administrator controls how many of each type of days off an employee has available per year. E.g.:
            - Vacation days: 20
            - Personal days: 5
            - Sick days: 5

            In some cases, the number of days varies per employee, e.g. based on their highest education level.

            Because of this, we should be able to override the number of days on a per employee basis.

            There should be a table of all employees allowing the system admin to view and manage all employee data
            (HRs, employees, PMs, other admins). The table should be searchable by email and name.

            6. Employees
                1. Be able to override the number of available days of for each type on a per employee basis
                2. Add / remove employees
                3. Edit employee data

        USER:
            HR, PM
        TASK:
            1.  HR and PM can see a list of all employees and search and filter them by email, county, city
            2.  HRs and PMs should be able to open details of any employee and see a detailed history of their
            vacations and days off, as well as an overview of how many days they worked this month and previous month.
    </pre>
@endsection

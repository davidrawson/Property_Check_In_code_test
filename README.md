## The Problem

You are a property manager at a busy Edinburgh letting agency. It is a month before Freshers’ week and you have 30 property check- ins to book with yourself and two of your colleagues. Each tenant supplies you with an application form that one of your team has placed into a CSV file. The file includes:
Tenant ID, First name, surname, email address, telephone number, required move-in date, required move-in time, property ID (that they took from the advertisement).

The move-in time will always be either on the hour or on the half hour.

Each property may have one or multiple tenants moving in (each of which have a form providing the details above).

Calculate a list of properties for you and your colleagues to visit (take into account 30 minutes travel time between appointments). Where there are any conflicts in times/dates a second property manager should be assigned a second list and, only if necessary, a third property manager can assist on any busy days.

Identify any situations where there are more than three conflicts so that the tenants can be contacted to arrange another appointment. Please also identify any property move-ins falling on the last day of the month as your company does not do move-ins on this date.

## The Requirement

Write an API that allows you to solve the problem above. The dataset can be devised and provided in a format defined by you. The lists returned should be defined in a format that is compatible with the input format. The API is to be an internal PHP API so it will only communicate with other parts of a PHP application, not server to server, nor server to client. Use PHP-doc to document the input and output your API accepts / returns.

No third-party frameworks are to be used apart from for testing. All code should be started from scratch.

## Create Check Ins Lists

Install PHPUnit in the directory.

`composer require --dev phpunit/phpunit ^9`


Run tests

`phpunit BookingTest.php`

`phpunit BookingListTest.php`

`phpunit CreateCheckInsListsTest.php`

CLI command to run the class 

`php -r 'include "CreateCheckInsLists.php"; CreateCheckInsLists::execute("application_forms.csv");'`

## Assumptions
- The csv file is to be placed in the same directory.
- Check-ins with multiple tenants in the same property all move in on the same day and time.
- Check-ins can take up to 30 mins, and travelling time is 30 mins.

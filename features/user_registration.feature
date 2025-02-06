Feature: User Registration

  Scenario: Register a new user
    Given I am on "/register"
    When I fill in "email" with "newuser@example.com"
    And I fill in "username" with "newuser"
    And I fill in "password" with "password"
    And I press "Register"
    Then I should see "Registration successful"

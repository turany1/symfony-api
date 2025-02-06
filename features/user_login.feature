Feature: User Login

  Scenario: Login with valid credentials
    Given I am on "api/login"
    When I fill in "email" with "user1@example.com"
    And I fill in "password" with "password"
    And I press "Login"
    Then I should see "Login successful"

  Scenario: Login with invalid credentials
    Given I am on "api/login"
    When I fill in "email" with "user1@example.com"
    And I fill in "password" with "wrongpassword"
    And I press "Login"
    Then I should see "Invalid credentials"

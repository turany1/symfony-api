Feature: Profile Viewing

  Scenario: View user profile
    Given I am logged in as "user1@example.com" with "password"
    When I go to "/profile"
    Then I should see "user1@example.com"
    And I should see "ROLE_USER"

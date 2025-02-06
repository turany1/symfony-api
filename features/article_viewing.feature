Feature: Article Viewing

  Scenario: View an article
    Given there is an article titled "Existing Article" with content "This is an existing article."
    When I go to "/articles/1"
    Then I should see "Existing Article"
    And I should see "This is an existing article."

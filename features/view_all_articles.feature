Feature: Viewing All Articles

  Scenario: View all articles
    Given there are articles titled "Article One", "Article Two", and "Article Three"
    When I go to "api/articles"
    Then I should see "Article One"
    And I should see "Article Two"
    And I should see "Article Three"

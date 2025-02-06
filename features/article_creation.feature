Feature: Article Creation

  Scenario: Create a new article
    Given I am logged in as "author@example.com" with "password"
    When I go to "api/article/"
    And I fill in "title" with "New Article"
    And I fill in "content" with "This is a new article."
    And I press "Create"
    Then I should see "Article created successfully"

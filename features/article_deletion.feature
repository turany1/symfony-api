Feature: Article Deletion

  Scenario: Delete an article
    Given there is an article titled "Article to Delete" with content "This article will be deleted."
    And I am logged in as "author@example.com" with "password"
    When I go to "api/article/1"
    And I press "Delete"
    Then I should see "Article deleted successfully"

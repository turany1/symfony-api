Feature: Article Update

  Scenario: Update an existing article
    Given there is an article titled "Old Title" with content "Old Content."
    And I am logged in as "author@example.com" with "password"
    When I go to "/articles/1/edit"
    And I fill in "title" with "Updated Title"
    And I fill in "content" with "Updated Content."
    And I press "Update"
    Then I should see "Article updated successfully"
    And I should see "Updated Title"
    And I should see "Updated Content."

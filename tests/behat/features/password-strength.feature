@retry
Feature: See password strength
  As a CMS user
  I want feedback on my password strength
  So that I create a secure password

  Background:
    Given a "member" "Admin" with "Email"="admin@example.org"

  Scenario: I get feedback when resetting my password
    Given I go to "Security/login"
    When I follow "I've lost my password"
    And I fill in "admin@example.org" for "Email"
    And I press the "Send me the password reset link" button
    Then there should be an email to "admin@example.org" titled "Your password reset link"
    When I click on the "password reset link" link in the email to "admin@example.org"
    Then I should see "Please enter a new password"

    When I fill in "the" for "Password"
    And I wait for 1 second
    Then I should see "Password strength: Very weak"
    And I should see "The password strength is too low. Please use a stronger password."

    When I fill in "the-quick-br" for "Password"
    And I wait for 1 second
    Then I should see "Password strength: Weak"
    And I should see "The password strength is too low. Please use a stronger password."

    When I fill in "the-quick-brow" for "Password"
    And I wait for 1 second
    Then I should see "Password strength: Medium"
    And I should not see "The password strength is too low. Please use a stronger password."

    When I fill in "the-quick-brown-fox" for "Password"
    And I wait for 1 second
    Then I should see "Password strength: Strong"
    And I should not see "The password strength is too low. Please use a stronger password."

    When I fill in "the-quick-brown-fox-jumps-over" for "Password"
    And I wait for 1 second
    Then I should see "Password strength: Very strong"
    And I should not see "The password strength is too low. Please use a stronger password."

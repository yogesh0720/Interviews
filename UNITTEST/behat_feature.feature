# features/calculator.feature
# Behat - Behavior-Driven Development (BDD) testing framework
#
# WHEN TO USE:
# - Acceptance testing with stakeholders
# - Behavior-driven development
# - End-to-end testing
# - Testing user stories
#
# WHY USE:
# - Natural language scenarios (Gherkin)
# - Bridges gap between business and technical teams
# - Living documentation
# - Focuses on user behavior rather than implementation

Feature: Calculator operations
  In order to perform calculations
  As a user
  I need to be able to use basic math operations

  Scenario: Adding two numbers
    Given I have a calculator
    When I add 5 and 3
    Then the result should be 8

  Scenario Outline: Multiple additions
    Given I have a calculator
    When I add <first> and <second>
    Then the result should be <result>

    Examples:
      | first | second | result |
      | 1     | 2      | 3      |
      | 10    | 15     | 25     |
      | 0     | 0      | 0      |
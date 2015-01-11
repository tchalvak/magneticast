#api.feature
Feature:
  In it's simplest form, the api should be able to pull
  ideas out even if no user is logged in.  At the very least,
  all public ideas should be able to be pulled.

  Scenario: write some users "context" info
  Given I have phrases in system:
    | phrase | rating              |
    | ninja    | 5  |
    | wizard   | 4 |
  Given I am not logged in
  When I move to the url "/api/phrases"
  Then I should get:
  """
  [{"phrase":"ninja","rating":"5"},{"phrase":"wizard","rating":"4"}]
  """
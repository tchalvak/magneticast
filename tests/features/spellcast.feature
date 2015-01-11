Feature: spellcast
  Who/what/where/why
  In order to cast a spell, any user should be able to go to the url
  And see the results of casting such a spell

  Scenario:
    Given I can load the dev url "/"
    When I move to the url "/cast/fireball"
    Then I should get:
      """
      You cast fireball!
      """
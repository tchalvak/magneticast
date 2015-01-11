Feature: cast-on-target
   Who/what/where/why
   When I want to cast a spell on a target, I need only go to append
   a target to the standard casting url

   Scenario:
   	Given I can cast "/cast/magicmissile"
   	And the target "john" has "5" hitpoints
   	When I cast "magicmissile" on "john"
   	Then He loses some health
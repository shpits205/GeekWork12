<?php

namespace Acme\TestBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\TestBundle\Entity\Post;
use Acme\TestBundle\Entity\Tags;
use Acme\TestBundle\Entity\Category;

class LoadPostData extends AbstractFixture
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $textPost = "The United States of America (USA), commonly referred to as the United States (US),
        America, or simply the States, is a federal republic[10][11] consisting of 50 states and a federal district.
        The 48 contiguous states and the federal district of Washington, D.C., are in central North America between Canada and Mexico.
        The state of Alaska is the northwestern part of North America and the state of Hawaii is an archipelago in the mid-Pacific.
        The country also has five populated and nine unpopulated territories in the Pacific and the Caribbean.
        At 3.79 million square miles (9.83 million km2) in total and with around 316 million people, the United States is the fourth-largest country by total area and third largest by population.
        It is one of the world's most ethnically diverse and multicultural nations, the product of large-scale immigration from many countries.[12] The geography and climate of the United States is also extremely diverse, and it is home to a wide variety of wildlife.
        Paleo-indians migrated from Asia to what is now the U.S. mainland around 15,000 years ago,[13] with European colonization beginning in the 16th century. The United States emerged from 13 British colonies located along the Atlantic seaboard.
        Disputes between Great Britain and these colonies led to the American Revolution. On July 4, 1776, delegates from the 13 colonies unanimously issued the Declaration of Independence.
        The ensuing war ended in 1783 with the recognition of independence of the United States from the Kingdom of Great Britain, and was the first successful war of independence against a European colonial empire.
        The current Constitution was adopted on September 17, 1787. The first 10 amendments, collectively named the Bill of Rights, were ratified in 1791 and guarantee many fundamental civil rights and freedoms.
        Driven by the doctrine of manifest destiny, the United States embarked on a vigorous expansion across North America throughout the 19th century.[16]
        This involved displacing native tribes, acquiring new territories, and gradually admitting new states.[16] The American Civil War ended legal slavery in the country.[17]
        By the end of the 19th century, the United States extended into the Pacific Ocean,[18] and its economy was the world's largest.
        [19] The Spanish–American War and World War I confirmed the country's status as a global military power. The United States emerged from World War II as a global superpower, the first country with nuclear weapons, and a permanent member of the United Nations Security Council.
        The end of the Cold War and the dissolution of the Soviet Union left the United States as the sole superpower.";

        $arraytag = Array();
        $tagId = Array();
        for ($j = 0; $j < 10; $j++) {
            $tag = new Tags();
            $tag->setTextTag("tag" . $j);
            $manager->persist($tag);
            array_push($arraytag,$tag);
            array_push($tagId,$j);
        }
        $manager->flush();
        for ($cat = 0; $cat < 3; $cat++) {
            $categoryMain = new Category();
            $categoryMain->setTitle("CategoryMain".$cat);
            $categoryMain->setParentCategory();
            for ($i = 0; $i < 5; $i++) {
                $post = new Post();
                $post->setTitle("title" . $i . $cat);

                $categ = new Category();
                $categ->setTitle("category1" . $i);
                $categ->setParentCategory($categoryMain);
                shuffle($tagId);
                $slice = array_slice($tagId, 0, 3);
                foreach ($slice as $key) {
                    $post->addTag($arraytag[$key]);
                }
                $post->setImage("image" . $i . $cat);

                $post->setViewed(0);
                $post->setTextPost($textPost);
                $post->setCategory($categ);
                $manager->persist($categoryMain);
                $manager->persist($categ);
                $manager->persist($post);
            }
        }
        $manager->flush();
    }
}